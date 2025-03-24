<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGrupoAPIRequest;
use App\Http\Requests\API\UpdateGrupoAPIRequest;
use App\Models\Grupo;
use App\Repositories\GrupoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class GrupoAPIController
 */
class GrupoAPIController extends AppBaseController
{
    private GrupoRepository $grupoRepository;

    public function __construct(GrupoRepository $grupoRepo)
    {
        $this->grupoRepository = $grupoRepo;
    }

    /**
     * Display a listing of the Grupos.
     * GET|HEAD /grupos
     */
    public function index(Request $request): JsonResponse
    {
        $grupos = $this->grupoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($grupos->toArray(), 'Grupos retrieved successfully');
    }

    /**
     * Store a newly created Grupo in storage.
     * POST /grupos
     */
    public function store(CreateGrupoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $grupo = $this->grupoRepository->create($input);

        return $this->sendResponse($grupo->toArray(), 'Grupo saved successfully');
    }

    /**
     * Display the specified Grupo.
     * GET|HEAD /grupos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Grupo $grupo */
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            return $this->sendError('Grupo not found');
        }

        return $this->sendResponse($grupo->toArray(), 'Grupo retrieved successfully');
    }

    /**
     * Update the specified Grupo in storage.
     * PUT/PATCH /grupos/{id}
     */
    public function update($id, UpdateGrupoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Grupo $grupo */
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            return $this->sendError('Grupo not found');
        }

        $grupo = $this->grupoRepository->update($input, $id);

        return $this->sendResponse($grupo->toArray(), 'Grupo updated successfully');
    }

    /**
     * Remove the specified Grupo from storage.
     * DELETE /grupos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Grupo $grupo */
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            return $this->sendError('Grupo not found');
        }

        $grupo->delete();

        return $this->sendSuccess('Grupo deleted successfully');
    }
}
