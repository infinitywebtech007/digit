<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    // public function parties()
    // {
    //     return $this->hasMany(Party::class);
    // }

    function usermenu_profile_url()
    {
        return '/profile'; // Adjust to your profile route
    }
    function adminlte_profile_url()
    {
        return '/profile'; // Adjust to your profile route
    }

    function adminlte_image()
    {
        return '/img/user.svg'; // Adjust to your profile route
    }

    function adminlte_desc()
    {
        return auth()->user()->email; // Adjust to your profile route
    }

}
