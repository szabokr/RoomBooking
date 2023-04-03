<?php

namespace App\Http\Controllers;

use App\Models\RoomBookings;
use App\Models\User;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomBookingsController extends Controller
{
    public $model = RoomBookings::class;

    public function list()
    {
        $user = Auth::user();
        if ($user['permission_id'] == 2) {
            $results = $this->model::with(['user', 'room'])->where('user_id', $user['id'])->get();
            return response()->json(['success' => true, 'results' => $results], 200);
        }
        $results = $this->model::with(['user', 'room'])->get();
        return response()->json(['success' => true, 'results' => $results], 200);
    }

    public function update(Request $request, $id)
    {
        $model = $this->model::find($id);
        if (!$model) {
            return response()->json([
                'success' => false,
                'message' => "Record not found!"
            ], 422);
        }
        $data = $request->validate($this->model::$validationStatus);
        $model->status = $data['status'];
        $model->save();
        return response()->json(['success' => true], 201);
    }

    public function create(Request $request)
    {
        $data = $request->validate($this->model::$validationGuest);
        $user = Auth::user();
        if ($user == null) {
            $user = User::where('email', $data['email'])->first();
            $roomBooking = 0;
            if ($user) {
                $roomBooking = $this->model::where('user_id', $user['id'])->where('status', 0)->count();
            }
            if ($roomBooking != 0) {

                return response()->json([
                    'success' => false,
                    'message' => "You already have an unaccepted reservation in our system."
                ], 208);
            }
        }

        $roomBookings = RoomBookings::where('room_id', $data['room_id'])
            ->where(function ($query) use ($data) {
                $query->whereBetween('date_of_arrive', [$data['date_of_arrive'], $data['date_of_departure']])
                    ->orWhereBetween('date_of_departure', [$data['date_of_arrive'], $data['date_of_departure']])
                    ->orWhere(function ($query) use ($data) {
                        $query->where('date_of_arrive', '<=', $data['date_of_arrive'])
                            ->where('date_of_departure', '>=', $data['date_of_departure']);
                    });
            })
            ->count();
        if ($roomBookings != 0) {
            return response()->json([
                'success' => false,
                'message' => "This room is already booked for this date"
            ], 208);
        }
        if ($user == null) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        }
        $this->model::create([
            'room_id' => $data['room_id'],
            'user_id' => $user['id'],
            'date_of_arrive' => $data['date_of_arrive'],
            'date_of_departure' => $data['date_of_departure'],
        ]);

        return response()->json(['success' => true], 201);
    }
}
