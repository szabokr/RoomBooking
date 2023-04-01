<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public $model = Rooms::class;

    public function list()
    {
        $results =  $this->model::all();
        return response()->json(['success' => true, 'results' => $results], 200);
    }
}
