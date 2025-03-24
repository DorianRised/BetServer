<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTipsterAPIRequest;
use App\Http\Requests\API\UpdateTipsterAPIRequest;
use App\Models\Tipster;
use App\Repositories\TipsterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class TipsterAPIController
 */
class TipsterAPIController extends AppBaseController
{
    private TipsterRepository $tipsterRepository;

    public function __construct(TipsterRepository $tipsterRepo)
    {
        $this->tipsterRepository = $tipsterRepo;
    }

    /**
     * Display a listing of the Tipsters.
     * GET|HEAD /tipsters
     */
    public function index(Request $request): JsonResponse
    {
        $tipsters = $this->tipsterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tipsters->toArray(), 'Tipsters retrieved successfully');
    }

    /**
     * Store a newly created Tipster in storage.
     * POST /tipsters
     */
    public function store(CreateTipsterAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $tipster = $this->tipsterRepository->create($input);

        return $this->sendResponse($tipster->toArray(), 'Tipster saved successfully');
    }

    /**
     * Display the specified Tipster.
     * GET|HEAD /tipsters/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Tipster $tipster */
        $tipster = $this->tipsterRepository->find($id);

        if (empty($tipster)) {
            return $this->sendError('Tipster not found');
        }

        return $this->sendResponse($tipster->toArray(), 'Tipster retrieved successfully');
    }

    /**
     * Update the specified Tipster in storage.
     * PUT/PATCH /tipsters/{id}
     */
    public function update($id, UpdateTipsterAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Tipster $tipster */
        $tipster = $this->tipsterRepository->find($id);

        if (empty($tipster)) {
            return $this->sendError('Tipster not found');
        }

        $tipster = $this->tipsterRepository->update($input, $id);

        return $this->sendResponse($tipster->toArray(), 'Tipster updated successfully');
    }

    /**
     * Remove the specified Tipster from storage.
     * DELETE /tipsters/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Tipster $tipster */
        $tipster = $this->tipsterRepository->find($id);

        if (empty($tipster)) {
            return $this->sendError('Tipster not found');
        }

        $tipster->delete();

        return $this->sendSuccess('Tipster deleted successfully');
    }
}
