<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Exception;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function create(Request $request)
    {
        try {
            $position = new Position();
            $position->Latitude = $request->Latitude;
            $position->Longitude = $request->Longitude;
            $position->refAdresse = $request->refAdresse;

            $position->save();
            return response()->json([
                'success' => true,
                'message' => 'valie alertv',
                'alertv' => $position
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
