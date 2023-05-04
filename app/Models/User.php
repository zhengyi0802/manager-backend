<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'line_id',
        'email',
        'password',
        'role',
        'created_by',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function manager() {
         return $this->hasOne(Manager::class, 'user_id');
    }

    public function member() {
        return $this->hasOne(Member::class, 'user_id');
    }

    public function admins($query) {
        return $query->where('role', UserRole::Administrator);
    }

    public function managers($query) {
        return $query->where('role', UserRole::Manager);
    }

    public function resellers($query) {
        return $query->where('role', UserRole::Reseller);
    }

    public function distrobuters($query) {
        return $query->where('role', UserRole::Distrobuter);
    }

    public function memberLists($query) {
        return $query->where('role', UserRole::Member);
    }
}
