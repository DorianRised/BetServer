<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeporteAPIRequest;
use App\Http\Requests\API\UpdateDeporteAPIRequest;
use App\Models\Deporte;
use App\Repositories\DeporteRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Storage;
use App\Models\Liga;

/**
 * Class DeporteAPIController
 */
class DeporteAPIController extends AppBaseController
{
    private DeporteRepository $deporteRepository;

    public function __construct(DeporteRepository $deporteRepo)
    {
        $this->deporteRepository = $deporteRepo;
    }

    /**
     * Display a listing of the Deportes.
     * GET|HEAD /deportes
     */
    public function index(Request $request): JsonResponse
    {
        $deportes = $this->deporteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($deportes->toArray(), 'Deportes retrieved successfully');
    }

    /**
     * Store a newly created Deporte in storage.
     * POST /deportes
     */
    public function store(CreateDeporteAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $deporte = $this->deporteRepository->create($input);

        return $this->sendResponse($deporte->toArray(), 'Deporte saved successfully');
    }

    /**
     * Display the specified Deporte.
     * GET|HEAD /deportes/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Deporte $deporte */
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            return $this->sendError('Deporte not found');
        }

        return $this->sendResponse($deporte->toArray(), 'Deporte retrieved successfully');
    }

    /**
     * Update the specified Deporte in storage.
     * PUT/PATCH /deportes/{id}
     */
    public function update($id, UpdateDeporteAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Deporte $deporte */
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            return $this->sendError('Deporte not found');
        }

        $deporte = $this->deporteRepository->update($input, $id);

        return $this->sendResponse($deporte->toArray(), 'Deporte updated successfully');
    }

    /**
     * Remove the specified Deporte from storage.
     * DELETE /deportes/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Deporte $deporte */
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            return $this->sendError('Deporte not found');
        }

        $deporte->delete();

        return $this->sendSuccess('Deporte deleted successfully');
    }


    public function ligasPorDeporte($deporteId)
    {
        $ligas = Liga::where('deporte_id', $deporteId)
                    ->orderBy('nombre', 'asc')
                    ->get(['id', 'nombre']);

        return response()->json($ligas);
    }
}
