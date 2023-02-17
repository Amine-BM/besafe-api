<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alertv;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertVController extends Controller
{
    public function create(Request $request)
    {
        try {
            $alertv = new Alertv();
            $alertv->RefUser = Auth::user()->id;
            $alertv->RefPosition = $request->RefPosition;
            $alertv->nivDanger = $request->nivDanger;

            $alertv->save();
            $alertv->user();

            return response()->json([
                'success' => true,
                'message' => 'valide alertv',
                'RefUser' => $alertv->RefUser,
                'RefPosition' => $alertv->RefPosition,
                'nivDanger' => $alertv->nivDanger,
                'idAlerteV' => $alertv->idAlerteV,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function update(Request $request)
    {
        $alertv = Alertv::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'succes' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $alertv->nivDanger = $request->nivDanger;
        $alertv->RefPosition = $request->RefPosition;
        $alertv->update();
        return response()->json([
            'success' => true,
            'message' => 'alertv update',
            'alertv' => $alertv
        ]);
    }

    public function delete(Request $request)
    {
        $alertv = Alertv::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'succes' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $alertv->delete();
        return response()->json([
            'success' => true,
            'message' => 'alertv delete',
        ]);
    }

    public function alertvs()
    {
        $alertvs = Alertv::all();
        $alertvCustom = [];
        $alertvsCustom = [];
        foreach ($alertvs as $alertv) {
            $alertvCustom['userAlertV'] = $alertv->user;
            $alertvCustom['positionAlertV'] = $alertv->position;
            $alertv->position->adresse->ville;
            array_push($alertvsCustom, $alertvCustom);
        }
        return response()->json([
            'success' => true,
            'message' => 'alertvs récupérer',
            'alertvs' => $alertvsCustom
        ]);
    }
}
