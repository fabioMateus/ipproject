<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

class PositionController extends Controller
{
    public function store(Request $request)
    {
        $position = Position::create($request->all());

        return response()->json($position, 201);
    }

    public function showPosition()
    {
        $position = Position::all()->last();

        return view('welcome', ['x'=>$position->x, 'y'=>$position->y]);
    }

    public function getPosition(Request $request)
    {
        $position = Position::all()->last();

        $response = array(
            'status' => 'success',
            'x' => $position->x,
            'y' => $position->y
        );
        return response()->json($response);
    }
}
