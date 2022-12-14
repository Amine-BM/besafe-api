<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlerteGouv;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlerteGouvController extends Controller
{
    public function create(Request $request)
    {
        try {
            $alerteGouv = new AlerteGouv();
            $alerteGouv->Annee = $request->Annee;
            $alerteGouv->Mois = $request->Mois;
            $alerteGouv->NombreCrime = $request->NombreCrime;
            $alerteGouv->LibeleeAlerte = $request->LibeleeAlerte;
            $alerteGouv->RefDepartement = $request->RefDepartement;

            $alerteGouv->save();
            return response()->json([
                'success' => true,
                'message' => 'valide alerte gouv',
                'alertv' => $alerteGouv
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
        $alerteGouv = AlerteGouv::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'succes' => false,
                'message' => 'unauthorized access'
            ]);
        }
        $alerteGouv->Annee = $request->Annee;
        $alerteGouv->Mois = $request->Mois;
        $alerteGouv->LibeleeAlerte = $request->LibeleeAlerte;
        $alerteGouv->RefDepartement = $request->RefDepartement;
        $alerteGouv->update();
        return response()->json([
            'success' => true,
            'message' => 'alertegouv update',
            'alertv' => $alerteGouv
        ]);
    }

    public function delete(Request $request)
    {
        $alertv = AlerteGouv::find($request->id);
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

    public function alerteGouvs()
    {
        $alertegouvs = AlerteGouv::all();
        $alertegouvCustom = [];
        $alertegouvsCustom = [];
        foreach ($alertegouvs as $alertegouv) {
            $alertegouvCustom['alerteGouv'] = $alertegouv;
            $alertegouv->departement;
            array_push($alertegouvsCustom, $alertegouvCustom);
        }
        return response()->json([
            'success' => true,
            'message' => 'alertvs récupérer',
            'alertegouvs' => $alertegouvsCustom
        ]);
    }
}
