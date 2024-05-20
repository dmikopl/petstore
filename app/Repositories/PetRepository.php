<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class PetRepository
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('PETSTORE_API_BASE_URL');
    }

    public function getPetsByStatus($status)
    {
        $response = Http::get("{$this->baseUrl}/pet/findByStatus", ['status' => $status]);
        return $response->json();
    }

    public function getPetById($id)
    {
        $response = Http::get("{$this->baseUrl}/pet/{$id}");
        return $response->json();
    }

    public function addPet($petData)
    {
        $response = Http::post("{$this->baseUrl}/pet", $petData);
        return $response->json();
    }

    public function updatePet($petData)
    {
        $response = Http::put("{$this->baseUrl}/pet", $petData);
        return $response->json();
    }

    public function deletePet($id)
    {
        $response = Http::delete("{$this->baseUrl}/pet/{$id}");
        return $response->json();
    }

    public function uploadPetImage($id, $image)
    {
        $response = Http::attach('file', $image)->post("{$this->baseUrl}/pet/{$id}/uploadImage");
        return $response->json();
    }
}
