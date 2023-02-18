<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlerteGouv;
use App\Models\AlerteGouvernementale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlerteGouvController extends Controller
{
    public function create(Request $request)
    {
        try {
            $alerteGouv = new AlerteGouvernementale();
            $alerteGouv->libelle = $request->libelle;
            $alerteGouv->type_alerte = $request->type_alerte;

            $alerteGouv->save();
            return response()->json([
                'success' => true,
                'message' => 'alerte gouvernementale créée',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }

    public function alertesGouvParDepartement(Request $request)
    {
        $codeDepartement = $request->code_departement;
        $alertesDepartementDB = AlerteGouvernementale::whereHas('ville.departement', function ($query) use ($codeDepartement) {
            $query->where('code', '=', $codeDepartement);
        })->get();
        $alerteCustom = [];
        $alertesCustom = [];
        foreach ($alertesDepartementDB as $alerteDepartementDB) {
            $alerteCustom['id'] = $alerteDepartementDB->id;
            $alerteCustom['typeAlerte'] = $alerteDepartementDB->type_alerte;
            $alerteCustom['libelle'] = $alerteDepartementDB->libelle;
            $alerteCustom['id_ville'] = $alerteDepartementDB->id_ville;
            array_push($alertesCustom, $alerteCustom);
        }
        return response()->json([
            'success' => true,
            'message' => 'alertes gouvernementale par département récupérées',
            'codeDepartement' => $codeDepartement,
            'alertes' => $alertesCustom
        ]);
    }
}
