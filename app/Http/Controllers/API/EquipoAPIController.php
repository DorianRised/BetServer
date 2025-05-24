<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEquipoAPIRequest;
use App\Http\Requests\API\UpdateEquipoAPIRequest;
use App\Models\Equipo;
use App\Repositories\EquipoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class EquipoAPIController
 */
class EquipoAPIController extends AppBaseController
{
    private EquipoRepository $equipoRepository;

    public function __construct(EquipoRepository $equipoRepo)
    {
        $this->equipoRepository = $equipoRepo;
    }

    /**
     * Display a listing of the Equipos.
     * GET|HEAD /equipos
     */
    public function index(Request $request): JsonResponse
    {
        $equipos = $this->equipoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($equipos->toArray(), 'Equipos retrieved successfully');
    }

    /**
     * Store a newly created Equipo in storage.
     * POST /equipos
     */
    public function store(CreateEquipoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $equipo = $this->equipoRepository->create($input);

        return $this->sendResponse($equipo->toArray(), 'Equipo saved successfully');
    }

    /**
     * Display the specified Equipo.
     * GET|HEAD /equipos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Equipo $equipo */
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            return $this->sendError('Equipo not found');
        }

        return $this->sendResponse($equipo->toArray(), 'Equipo retrieved successfully');
    }

    /**
     * Update the specified Equipo in storage.
     * PUT/PATCH /equipos/{id}
     */
    public function update($id, UpdateEquipoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Equipo $equipo */
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            return $this->sendError('Equipo not found');
        }

        $equipo = $this->equipoRepository->update($input, $id);

        return $this->sendResponse($equipo->toArray(), 'Equipo updated successfully');
    }

    /**
     * Remove the specified Equipo from storage.
     * DELETE /equipos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Equipo $equipo */
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            return $this->sendError('Equipo not found');
        }

        $equipo->delete();

        return $this->sendSuccess('Equipo deleted successfully');
    }
}
