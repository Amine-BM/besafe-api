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
            $adresse->Numero = $request->Numero;
            $adresse->Rue = $request->Rue;
            $adresse->RefVille = $request->RefVille;

            $adresse->save();
            return response()->json([
                'success' => true,
                'message' => 'valie alertv',
                'alertv' => $adresse
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '' . $e
            ]);
        }
    }
}
