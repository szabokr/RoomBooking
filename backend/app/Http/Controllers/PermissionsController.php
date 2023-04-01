<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public $model = Permissions::class;

    public function list()
    {
        $results = $this->model::whereNotIn('id', [1])->get();
        return response()->json(['success' => true, 'results' => $results], 200);
    }
}
