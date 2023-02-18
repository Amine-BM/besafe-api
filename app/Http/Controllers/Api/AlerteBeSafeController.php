<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Ville;
use App\Models\Adresse;
use App\Models\AlerteBeSafe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AlerteBeSafeController extends Controller
{
    public function create(Request $request)
    {
        try {
            $ville = Ville::where("libelle", '=', $request->input('adresse.ville'))->get()->first();
            $adresse = Adresse::create([
                'libelle' => $request->input('adresse.libelle'),
                'id_ville' => $ville->id
            ]);

            $alerte = new AlerteBeSafe();
            $alerte->id_user = Auth::user()->id;
            $alerte->id_adresse = $adresse->id;
            $alerte->niveau_danger = $request->niveau_danger;
            $alerte->type_alerte = $request->type_alerte;
            $alerte->libelle = $request->libelle;

            $alerte->save();
            $alerte->user();

            return response()->json([
                'success' => true,
                'message' => 'alerte BeSafe insérée',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ], 401);
        }
    }

    public function delete(Request $request)
    {
        if (Auth::user()->id != $request->id_user) {
            return response()->json([
                'succes' => false,
                'message' => 'unauthorized access'
            ], 401);
        }
        try {
            AlerteBeSafe::whereIn('id', $request->ids_alertes)->delete();
            return response()->json([
                'success' => true,
                'message' => 'alerte supprimées',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ], 401);
        }
    }

    public function alertes()
    {
        $alertesDB = AlerteBeSafe::all();
        $alerteCustom = [];
        $alertesCustom = [];
        foreach ($alertesDB as $alerteDB) {
            $alerteCustom['id'] = $alerteDB->id;
            $alerteCustom['id_user'] = $alerteDB->id_user;
            $alerteCustom['adresse'] = $alerteDB->adresse;
            $alerteCustom['type_alerte'] = $alerteDB->type_alerte;
            $alerteCustom['niveau_danger'] = $alerteDB->niveau_danger;
            $alerteCustom['libelle'] = $alerteDB->libelle;
            array_push($alertesCustom, $alerteCustom);
        }
        return response()->json([
            'success' => true,
            'message' => 'alertes BeSafe récupérées',
            'alertes' => $alertesCustom
        ]);
    }

    public function alertesUser(Request $request)
    {
        if (Auth::user()->id != $request->id_user) {
            return response()->json([
                'succes' => false,
                'message' => 'unauthorized access'
            ], 401);
        }
        $alertesUserDB = AlerteBeSafe::where('id_user', $request->id_user)->get();
        $alerteCustom = [];
        $alertesCustom = [];
        foreach ($alertesUserDB as $alerteUserDB) {
            $alerteCustom['id'] = $alerteUserDB->id;
            $alerteCustom['idUser'] = $alerteUserDB->id_user;
            $alerteCustom['adresse'] = $alerteUserDB->adresse;
            $alerteCustom['typeAlerte'] = $alerteUserDB->type_alerte;
            $alerteCustom['nivDanger'] = $alerteUserDB->niveau_danger;
            $alerteCustom['libelle'] = $alerteUserDB->libelle;
            array_push($alertesCustom, $alerteCustom);
        }
        return response()->json([
            'success' => true,
            'message' => 'alertes BeSafe pour user récupérées',
            'alertes' => $alertesCustom
        ]);
    }

    public function alertesParDepartement(Request $request)
    {
        $codeDepartement = $request->code_departement;
        $alertesDepartementDB = AlerteBeSafe::whereHas('adresse.ville.departement', function ($query) use ($codeDepartement) {
            $query->where('code', '=', $codeDepartement);
        })->get();
        $alerteCustom = [];
        $alertesCustom = [];
        foreach ($alertesDepartementDB as $alerteDepartementDB) {
            $alerteCustom['id'] = $alerteDepartementDB->id;
            $alerteCustom['idUser'] = $alerteDepartementDB->id_user;
            $alerteCustom['adresse'] = $alerteDepartementDB->adresse;
            $alerteCustom['typeAlerte'] = $alerteDepartementDB->type_alerte;
            $alerteCustom['nivDanger'] = $alerteDepartementDB->niveau_danger;
            $alerteCustom['libelle'] = $alerteDepartementDB->libelle;
            array_push($alertesCustom, $alerteCustom);
        }
        return response()->json([
            'success' => true,
            'message' => 'alertes BeSafe pour user récupérées',
            'codeDepartement' => $codeDepartement,
            'alertes' => $alertesCustom
        ]);
    }
}
