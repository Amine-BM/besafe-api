<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Adresse;
use Exception;
use Illuminate\Http\Request;

class AdresseController extends Controller
{
    public function create(Request $request)
    {
        try {
            $adresse = new Adresse();
            $adresse->libelle = $request->libelle;
            $adresse->code_ville = $request->code_ville;

            $adresse->save();
            return response()->json([
                'success' => true,
                'message' => 'adresse',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
