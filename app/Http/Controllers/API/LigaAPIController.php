<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLigaAPIRequest;
use App\Http\Requests\API\UpdateLigaAPIRequest;
use App\Models\Liga;
use App\Repositories\LigaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class LigaAPIController
 */
class LigaAPIController extends AppBaseController
{
    private LigaRepository $ligaRepository;

    public function __construct(LigaRepository $ligaRepo)
    {
        $this->ligaRepository = $ligaRepo;
    }

    /**
     * Display a listing of the Ligas.
     * GET|HEAD /ligas
     */
    public function index(Request $request): JsonResponse
    {
        $ligas = $this->ligaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ligas->toArray(), 'Ligas retrieved successfully');
    }

    /**
     * Store a newly created Liga in storage.
     * POST /ligas
     */
    public function store(CreateLigaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $liga = $this->ligaRepository->create($input);

        return $this->sendResponse($liga->toArray(), 'Liga saved successfully');
    }

    /**
     * Display the specified Liga.
     * GET|HEAD /ligas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Liga $liga */
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            return $this->sendError('Liga not found');
        }

        return $this->sendResponse($liga->toArray(), 'Liga retrieved successfully');
    }

    /**
     * Update the specified Liga in storage.
     * PUT/PATCH /ligas/{id}
     */
    public function update($id, UpdateLigaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Liga $liga */
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            return $this->sendError('Liga not found');
        }

        $liga = $this->ligaRepository->update($input, $id);

        return $this->sendResponse($liga->toArray(), 'Liga updated successfully');
    }

    /**
     * Remove the specified Liga from storage.
     * DELETE /ligas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Liga $liga */
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            return $this->sendError('Liga not found');
        }

        $liga->delete();

        return $this->sendSuccess('Liga deleted successfully');
    }
}
