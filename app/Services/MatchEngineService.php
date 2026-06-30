<?php

namespace App\Services;

use App\Models\User;
use App\Models\Job;
use App\Models\MatchRule;

class MatchEngineService
{
    /**
     * Calculate match score detailed analytics for a candidate against a job
     * 
     * @param User $candidate
     * @param Job $job
     * @return array
     */
    public function calculateMatch(User $candidate, Job $job): array
    {
        // 1. Get Match weights from DB or defaults
        $rule = MatchRule::where('is_active', true)->first();
        $wSkill = $rule ? $rule->skill_weight : 40;
        $wExperience = $rule ? $rule->experience_weight : 20;
        $wSalary = $rule ? $rule->salary_weight : 15;
        $wLocation = $rule ? $rule->location_weight : 15;
        $wEducation = $rule ? $rule->education_weight : 10;

        // 2. Skill Match (40%)
        $skillScore = 100;
        $jobSkills = $job->skills;
        if (!is_array($jobSkills)) {
            $jobSkills = is_string($jobSkills) ? json_decode($jobSkills, true) ?? explode(',', $jobSkills) : [];
        }
        $jobSkills = array_filter(array_map('trim', $jobSkills ?: []));

        if (!empty($jobSkills)) {
            $candidateSkills = $candidate->skills;
            if (!is_array($candidateSkills)) {
                $candidateSkills = is_string($candidateSkills) ? json_decode($candidateSkills, true) ?? explode(',', $candidateSkills) : [];
            }
            $candidateSkills = array_filter(array_map('trim', $candidateSkills ?: []));

            $matchedSkillsCount = 0;
            foreach ($jobSkills as $js) {
                foreach ($candidateSkills as $cs) {
                    if (strcasecmp($js, $cs) === 0) {
                        $matchedSkillsCount++;
                        break;
                    }
                }
            }
            $skillScore = (count($jobSkills) > 0) ? round(($matchedSkillsCount / count($jobSkills)) * 100) : 100;
        }

        // 3. Experience Match (20%)
        $expScore = 100;
        $jobExp = $job->experience_years;
        if ($jobExp > 0) {
            $candExp = $candidate->experience_years ?? 0;
            if ($candExp >= $jobExp) {
                $expScore = 100;
            } else {
                $expScore = round(($candExp / $jobExp) * 100);
            }
        }

        // 4. Salary Match (15%)
        $salaryScore = 100;
        $minSal = $job->salary_min;
        $maxSal = $job->salary_max;
        $candSal = $candidate->expected_salary;

        if ($minSal && $maxSal && $candSal) {
            if ($candSal <= $maxSal) {
                $salaryScore = 100;
            } else {
                // Penalize if expected salary is higher than maximum salary
                $diff = $candSal - $maxSal;
                $pctOver = ($diff / $maxSal) * 100;
                $salaryScore = max(0, round(100 - $pctOver));
            }
        }

        // 5. Location Match (15%)
        $locationScore = 100;
        $jobLocType = strtolower($job->location_type); // Remote, Onsite, Hybrid
        $jobCity = strtolower(trim($job->city));
        $candCity = strtolower(trim($candidate->location ?? ''));

        if ($jobLocType !== 'remote') {
            if ($candCity === $jobCity) {
                $locationScore = 100;
            } elseif ($jobLocType === 'hybrid') {
                $locationScore = 60; // Fair match
            } else {
                $locationScore = 30; // Onsite in different city: poor match
            }
        }

        // 6. Education Match (10%)
        $eduScore = 100;
        $eduMapping = [
            'sma' => 1, 'smk' => 1, 'sma/smk' => 1, 'd3' => 2, 'diploma' => 2,
            's1' => 3, 'sarjana' => 3, 's2' => 4, 'magister' => 4, 's3' => 5, 'doktor' => 5
        ];

        $jobEduReq = strtolower(trim($job->education_level ?? ''));
        $candEdu = strtolower(trim($candidate->education_level ?? ''));

        if (!empty($jobEduReq)) {
            $jobVal = 1;
            foreach ($eduMapping as $key => $val) {
                if (str_contains($jobEduReq, $key)) { $jobVal = $val; break; }
            }
            $candVal = 0;
            foreach ($eduMapping as $key => $val) {
                if (str_contains($candEdu, $key)) { $candVal = $val; break; }
            }

            if ($candVal >= $jobVal) {
                $eduScore = 100;
            } else {
                $eduScore = round(($candVal / $jobVal) * 100);
            }
        }

        // 7. Calculate Weighted Overall Score
        $totalWeight = $wSkill + $wExperience + $wSalary + $wLocation + $wEducation;
        if ($totalWeight === 0) $totalWeight = 100;

        $overallScore = round(
            (($skillScore * $wSkill) +
            ($expScore * $wExperience) +
            ($salaryScore * $wSalary) +
            ($locationScore * $wLocation) +
            ($eduScore * $wEducation)) / $totalWeight
        );

        // 8. Competition Level & Acceptance Probability
        $appCount = $job->applications()->count();
        if ($appCount < 5) {
            $competitionLevel = 'Low';
            $competitionFactor = 0.95;
        } elseif ($appCount <= 15) {
            $competitionLevel = 'Medium';
            $competitionFactor = 0.85;
        } else {
            $competitionLevel = 'High';
            $competitionFactor = 0.65;
        }

        $acceptanceProbability = round($overallScore * $competitionFactor);

        return [
            'overall' => $overallScore,
            'skill_score' => $skillScore,
            'experience_score' => $expScore,
            'salary_score' => $salaryScore,
            'location_score' => $locationScore,
            'education_score' => $eduScore,
            'competition_level' => $competitionLevel,
            'acceptance_probability' => min(100, max(0, $acceptanceProbability)),
        ];
    }
}
