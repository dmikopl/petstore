<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetService;

class PetController extends Controller
{
    protected $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function show($petId)
    {
        return $this->petService->getPetById($petId);
    }

    public function add(Request $request)
    {
        $response =  $this->petService->addPet($request);
        if (!isset($response['code']) || $response['code'] == 200) {
            return redirect()->route('pets.spec', ['pet' => $response['id']])->with('success', 'Pet created successfully');
        } else {
            return redirect()->route('pets.index')->with('error', $response['message']);
        }
    }

    public function edit(Request $request)
    {
        $response = $this->petService->updatePet($request);
        if (!isset($response['code']) || $response['code'] == 200) {
            return redirect()->route('pets.spec', ['pet' => $response['id']])->with('success', 'Pet edited successfully');
        } else {
            return redirect()->route('pets.index')->with('error', $response['message']);
        }
    }

    public function update(Request $request, $petId)
    {
        $response = $this->petService->updatePetForm($petId, $request->all());
        if (!isset($response['code']) || $response['code'] == 200) {
            return redirect()->route('pets.spec', ['pet' => $petId])->with('success', 'Pet updated successfully');
        } else {
            return redirect()->route('pets.index')->with('error', $response['message']);
        }
    }

    public function delete($petId)
    {
        $response = $this->petService->deletePet($petId);
        return $this->handleResponse($response);
    }

    public function create()
    {
        return view('add');
    }

    public function spec($petId)
    {
        $pet = $this->show($petId);
        if (!isset($pet['code'])) {
            return view('spec', compact('pet'));
        } else {
            $statusCode = $pet['code'];
            return $this->codeMessage($statusCode, $pet);
        }
    }

    public function editView($petId)
    {
        $pet = $this->show($petId);

        return view('edit', compact('pet'));
    }

    public function updateView($petId)
    {
        $pet = $this->show($petId);

        return view('update', compact('pet'));
    }

    public function upload($petId)
    {
        $pet = $this->show($petId);

        return view('upload', compact('pet'));
    }

    public function index()
    {
        return view('index');
    }

    private function handleResponse($response)
    {
        try {
            $statusCode = $response->status();
            $result = match ($statusCode) {
                200 => ['status' => 200, 'message' => 'Operation successful'],
                400 => ['status' => 400, 'message' => 'Invalid request'],
                404 => ['status' => 404, 'message' => 'Resource not found'],
                default => ['status' => $statusCode, 'message' => 'An unexpected error occurred'],
            };

            if ($result['status'] == 200) {
                return redirect()->route('pets.index')->with('success', $result['message']);
            } else {
                return redirect()->route('pets.index')->with('error', $result['message']);
            }
        } catch (\Exception $e) {
            return redirect()->route('pets.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function uploadImage(Request $request, $petId)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // max 2MB
            'additionalMetadata' => 'nullable|string'
        ]);

        $response = $this->petService->uploadImage(
            $petId,
            $request->input('additionalMetadata'),
            $request->file('file')
        );

        if (!isset($response['code']) || $response['code'] == 200) {
            return redirect()->route('pets.spec', ['pet' => $petId])->with('success', 'File updated successfully');
        } else {
            $statusCode = $response['code'];
            return $this->codeMessage($statusCode, $response);
        }
    }

    public function findByStatus(Request $request)
    {
        $status = $request->input('status');

        $pets = $this->petService->findByStatus($status);
        if (!isset($pets['status'])) {
            return view('status', compact('pets'));
        } else {
            return  redirect()->route('pets.index')->with('error', $pets['message']);
        }
    }

    public function showFindByStatusForm()
    {
        return view('status');
    }

    private function codeMessage($statusCode, $message)
    {
        $result = match ($statusCode) {
            200 => ['status' => 200, 'message' => 'Operation successful'],
            400 => ['status' => 400, 'message' => 'Invalid request'],
            404 => ['status' => 404, 'message' => 'Resource not found'],
            default => ['status' => $statusCode, 'message' => $message],
        };
        return redirect()->route('pets.index')->with('error', $result['message']);
    }
}
