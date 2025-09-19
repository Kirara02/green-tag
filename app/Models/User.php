<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Complaint;
use App\Models\CollectionRoute;
use App\Models\Information;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    /**
     * Relasi: Seorang User (petugas) dapat menangani banyak Complaints.
     */
    public function handledComplaints(): HasMany
    {
        return $this->hasMany(Complaint::class, 'handler_id');
    }

    /**
     * Relasi: Seorang User (petugas) dapat bertanggung jawab atas banyak CollectionRoutes.
     */
    public function routesInCharge(): HasMany
    {
        return $this->hasMany(CollectionRoute::class, 'officer_in_charge_id');
    }

    /**
     * Relasi: Seorang User (admin/penulis) dapat mempublikasikan banyak Information.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Information::class, 'author_id');
    }
}
