<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UsersController extends Controller
{
    public $model = User::class;

    public function list()
    {
        $results = $this->model::whereNotIn('permission_id', [1, 3])->get();
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
        $data = $request->validate($this->model::$validationUpdate);
        $model->permission_id = $data['permission_id'];
        $model->save();
        return response()->json(['success' => true], 201);
    }
}
