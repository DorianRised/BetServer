<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipoApuestaAPIRequest;
use App\Http\Requests\API\UpdateTipoApuestaAPIRequest;
use App\Models\TipoApuesta;
use App\Repositories\TipoApuestaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class TipoApuestaAPIController
 */
class TipoApuestaAPIController extends AppBaseController
{
    private TipoApuestaRepository $tipoApuestaRepository;

    public function __construct(TipoApuestaRepository $tipoApuestaRepo)
    {
        $this->tipoApuestaRepository = $tipoApuestaRepo;
    }

    /**
     * Display a listing of the TipoApuestas.
     * GET|HEAD /tipo-apuestas
     */
    public function index(Request $request): JsonResponse
    {
        $tipoApuestas = $this->tipoApuestaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tipoApuestas->toArray(), 'Tipo Apuestas retrieved successfully');
    }

    /**
     * Store a newly created TipoApuesta in storage.
     * POST /tipo-apuestas
     */
    public function store(CreateTipoApuestaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $tipoApuesta = $this->tipoApuestaRepository->create($input);

        return $this->sendResponse($tipoApuesta->toArray(), 'Tipo Apuesta saved successfully');
    }

    /**
     * Display the specified TipoApuesta.
     * GET|HEAD /tipo-apuestas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var TipoApuesta $tipoApuesta */
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            return $this->sendError('Tipo Apuesta not found');
        }

        return $this->sendResponse($tipoApuesta->toArray(), 'Tipo Apuesta retrieved successfully');
    }

    /**
     * Update the specified TipoApuesta in storage.
     * PUT/PATCH /tipo-apuestas/{id}
     */
    public function update($id, UpdateTipoApuestaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var TipoApuesta $tipoApuesta */
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            return $this->sendError('Tipo Apuesta not found');
        }

        $tipoApuesta = $this->tipoApuestaRepository->update($input, $id);

        return $this->sendResponse($tipoApuesta->toArray(), 'TipoApuesta updated successfully');
    }

    /**
     * Remove the specified TipoApuesta from storage.
     * DELETE /tipo-apuestas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var TipoApuesta $tipoApuesta */
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            return $this->sendError('Tipo Apuesta not found');
        }

        $tipoApuesta->delete();

        return $this->sendSuccess('Tipo Apuesta deleted successfully');
    }
}
