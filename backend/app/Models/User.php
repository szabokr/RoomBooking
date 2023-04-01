<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'permission_id'
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];


    public static $validationRegister = [
        'name' => ['required', 'max:255', 'string'],
        'email' => ['required', 'unique:users', 'max:320', 'string', 'email'],
        'phone' => ['required', 'max:11', 'unique:users', 'string', 'regex:/^[0-9]+$/'],
        'password' => ['required', 'max: 30', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
    ];
    public static $validationRegisterInDatabase = [
        'name' => ['required', 'max:255', 'string'],
        'email' => ['required', 'max:320', 'string', 'email'],
        'phone' => ['required', 'max:11', 'string', 'regex:/^[0-9]+$/'],
        'password' => ['required', 'max: 30', 'string', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
    ];

    public static $validationLogin = [
        'email' => ['required'],
        'password' => ['required'],
    ];

    public static $validationUpdate = [
        'permission_id' => ['required', 'integer'],
    ];

    public function permission()
    {
        return $this->belongsTo(Permissions::class);
    }

    public function bookings()
    {
        return $this->hasMany(RoomBookings::class);
    }
}
