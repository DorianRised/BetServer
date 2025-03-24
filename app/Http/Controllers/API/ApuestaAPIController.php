<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApuestaAPIRequest;
use App\Http\Requests\API\UpdateApuestaAPIRequest;
use App\Models\Apuesta;
use App\Repositories\ApuestaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ApuestaAPIController
 */
class ApuestaAPIController extends AppBaseController
{
    private ApuestaRepository $apuestaRepository;

    public function __construct(ApuestaRepository $apuestaRepo)
    {
        $this->apuestaRepository = $apuestaRepo;
    }

    /**
     * Display a listing of the Apuestas.
     * GET|HEAD /apuestas
     */
    public function index(Request $request): JsonResponse
    {
        $apuestas = $this->apuestaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($apuestas->toArray(), 'Apuestas retrieved successfully');
    }

    /**
     * Store a newly created Apuesta in storage.
     * POST /apuestas
     */
    public function store(CreateApuestaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $apuesta = $this->apuestaRepository->create($input);

        return $this->sendResponse($apuesta->toArray(), 'Apuesta saved successfully');
    }

    /**
     * Display the specified Apuesta.
     * GET|HEAD /apuestas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Apuesta $apuesta */
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            return $this->sendError('Apuesta not found');
        }

        return $this->sendResponse($apuesta->toArray(), 'Apuesta retrieved successfully');
    }

    /**
     * Update the specified Apuesta in storage.
     * PUT/PATCH /apuestas/{id}
     */
    public function update($id, UpdateApuestaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Apuesta $apuesta */
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            return $this->sendError('Apuesta not found');
        }

        $apuesta = $this->apuestaRepository->update($input, $id);

        return $this->sendResponse($apuesta->toArray(), 'Apuesta updated successfully');
    }

    /**
     * Remove the specified Apuesta from storage.
     * DELETE /apuestas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Apuesta $apuesta */
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            return $this->sendError('Apuesta not found');
        }

        $apuesta->delete();

        return $this->sendSuccess('Apuesta deleted successfully');
    }
}
