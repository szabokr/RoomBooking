<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'phone',
        'room_id',
        'user_id',
        'date_of_arrive',
        'date_of_departure',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'date_of_arrive' => 'date:Y.m.d',
        'date_of_departure' => 'date:Y.m.d',
    ];

    public static $validationGuest = [
        'room_id' => ['exists:rooms,id'],
        'name' => ['required'],
        'email' => ['required', 'max:320', 'string',],
        'phone' => ['required', 'max:11', 'string', 'regex:/^[0-9]+$/'],
        'date_of_arrive' => ['required', 'date', 'before:date_of_departure'],
        'date_of_departure' => ['required', 'date', 'after:date_of_arrival'],
    ];


    public static $validationStatus = [
        'status' => ['required', 'integer'],
    ];


    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
