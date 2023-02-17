<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class AlerteBeSafeControllerTest extends TestCase
{
    /**
     * 
     *
     * @return void
     */
    public function test_doit_inserer_alerte_correctement()
    {
        $baseUrl = Config::get('app.url') . '/api/alerte/create';
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->json(
            'POST',
            $baseUrl . '/',
            [
                "niveau_danger" => "5",
                "id_user" => $user->id,
                "libelle" => "Agression au couteau",
                "type_alerte" => "PHYSIQUE",
                "adresse" => [
                    "libelle" => "33 rue Gabriel Péri",
                    "ville" => "Montrouge"
                ]
            ],
            [
                'Authorization' => 'Bearer ' . $token
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'message' => 'alerte BeSafe insérée'
            ]);
    }

    public function test_doit_retourner_erreur_quand_information_manquante_ou_incorrect_lors_insertion()
    {
        $baseUrl = Config::get('app.url') . '/api/alerte/create';
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->json(
            'POST',
            $baseUrl . '/',
            [
                "niveau_danger" => "5",
                "id_user" => "12",
                "libelle" => "Agression au couteau",
                "type_alerte" => "PHYSIQUE",
                "adresse" => [
                    "libelle" => "33 rue Gabriel Péri",
                    "id_ville" => "aaaa"
                ]
            ],
            [
                'Authorization' => 'Bearer ' . $token
            ]
        );
        $response
            ->assertStatus(401);
    }

    public function test_doit_recuperer_les_alertes_d_un_user()
    {
        $user = User::where('email', 'aaa')->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/alertes/user?id_user=' . $user->id;


        $response = $this->json(
            'GET',
            $baseUrl,
            [],
            ['Authorization' => 'Bearer ' . $token]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                "success" => true,
                "message" => "alertes BeSafe pour user récupérées",
                "alertes" => [
                    [
                        "id" => 14,
                        "idUser" => 2,
                        "adresse" => [
                            "id" => 21,
                            "libelle" => "75 avenue Jean JEAN PPPP",
                            "id_ville" => 17
                        ],
                        "typeAlerte" => "VERBALE",
                        "nivDanger" => 3,
                        "libelle" => "Insultes encore"
                    ],
                    [
                        "id" => 17,
                        "idUser" => 2,
                        "adresse" => [
                            "id" => 26,
                            "libelle" => "75 avenue Jean JEAN PPPP",
                            "id_ville" => 17
                        ],
                        "typeAlerte" => "VERBALE",
                        "nivDanger" => 3,
                        "libelle" => "Insultes encore"
                    ]
                ]
            ]);
    }
}
