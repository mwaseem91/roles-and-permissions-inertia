<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Referral;
use App\Models\Attachment;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    public function referralInformation()
    {
        return $this->hasOne(Referral::class, 'user_id', 'id');
    }


    public function billToInformation()
    {
        return $this->hasOne(BillToInformation::class);
    }

    public function claimantInformation()
    {
        return $this->hasOne(ClaimantInformation::class);
    }

    public function physicianInformation()
    {
        return $this->hasMany(PhysicianInformation::class);
    }

    public function issuesAndItemsToAddress()
    {
        return $this->hasOne(IssuesAndItemsToAddress::class);
    }

    public function attorneyInformation()
    {
        return $this->hasOne(AttorneyInformation::class);
    }
    public function defenseattorney()
    {
        return $this->hasOne(AttorneyInformation::class)->where('type', 'defense');
    }
    public function claimantAttorney()
    {
        return $this->hasOne(AttorneyInformation::class)->where('type', 'claimant');
    }

    public function appointmentInformation()
    {
        return $this->hasOne(AppointmentInformation::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }
}
