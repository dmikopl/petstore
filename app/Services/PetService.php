<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('PETSTORE_API_BASE_URL');
    }

    public function getPetById($petId)
    {
        return Http::get("{$this->baseUrl}/pet/{$petId}")->json();
    }

    public function addPet($data)
    {
        $formData = $this->prepareFormData($data);
        return Http::post("{$this->baseUrl}/pet", $formData)->json();
    }

    public function updatePet($data)
    {
        $formData = $this->prepareFormData($data);
        return Http::put("{$this->baseUrl}/pet", $formData)->json();
    }

    public function updatePetForm($petId, $data)
    {
        return Http::asForm()
            ->post("{$this->baseUrl}/pet/{$petId}", $data)
            ->json();
    }
    public function deletePet($petId)
    {
        return Http::delete("{$this->baseUrl}/pet/{$petId}");
    }

    public function uploadImage($petId, $additionalMetadata, $file)
    {
        $response = Http::attach(
            'file',
            file_get_contents($file->getPathname()),
            $file->getClientOriginalName()
        )->post("{$this->baseUrl}/pet/{$petId}/uploadImage", [
            'additionalMetadata' => $additionalMetadata,
        ]);

        return $response->json();
    }

    public function findByStatus($status)
    {
        $response = Http::get("{$this->baseUrl}/pet/findByStatus", [
            'status' => $status
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'status' => $response->status(),
                'message' => 'Error occurred while fetching pets by status'
            ];
        }
    }

    function prepareFormData($data)
    {
        $tags = [];
        $photoUrls = [];
        if (!empty($data->input('tags'))) {
            $tags = array_map(function ($tag) {
                [$id, $name] = explode(':', $tag);
                return ['id' => (int)$id, 'name' => $name];
            }, explode(',', $data->input('tags')));
        }
        if (!empty($data->input('photoUrls'))) {
            if (is_array($data->input('photoUrls'))) {
                $photoUrls = $data->input('photoUrls', []);
            } else {
                $photoUrls = explode(",", $data->input('photoUrls'));
            }
        }
        return [
            'id' => $data->input('id'),
            'name' => $data->input('name'),
            'status' => $data->input('status'),
            'category' => [
                'id' => (int)$data->input('category_id'),
                'name' => $data->input('category_name')
            ],
            'photoUrls' => $photoUrls,
            'tags' => $tags
        ];
    }
}
