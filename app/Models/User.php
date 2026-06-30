<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'name', 'email', 'password', 'role', 'phone', 'location', 'avatar',
    'cv_path', 'cv_ats_score', 'resume_strength', 'skills',
    'education_level', 'experience_years', 'expected_salary', 'bio'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'skills' => 'array',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCompany(): bool
    {
        return $this->role === 'company';
    }

    public function isCandidate(): bool
    {
        return $this->role === 'candidate';
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'candidate_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id')
                    ->orWhere('receiver_id', $this->id);
    }
}
