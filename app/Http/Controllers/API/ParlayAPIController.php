<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParlayAPIRequest;
use App\Http\Requests\API\UpdateParlayAPIRequest;
use App\Models\Parlay;
use App\Repositories\ParlayRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ParlayAPIController
 */
class ParlayAPIController extends AppBaseController
{
    private ParlayRepository $parlayRepository;

    public function __construct(ParlayRepository $parlayRepo)
    {
        $this->parlayRepository = $parlayRepo;
    }

    /**
     * Display a listing of the Parlays.
     * GET|HEAD /parlays
     */
    public function index(Request $request): JsonResponse
    {
        $parlays = Parlay::all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($parlays->toArray(), 'Parlays retrieved successfully');
    }

    /**
     * Store a newly created Parlay in storage.
     * POST /parlays
     */
    public function store(CreateParlayAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $parlay = $this->parlayRepository->create($input);

        return $this->sendResponse($parlay->toArray(), 'Parlay saved successfully');
    }

    /**
     * Display the specified Parlay.
     * GET|HEAD /parlays/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Parlay $parlay */
        $parlay = $this->parlayRepository->find($id);

        if (empty($parlay)) {
            return $this->sendError('Parlay not found');
        }

        return $this->sendResponse($parlay->toArray(), 'Parlay retrieved successfully');
    }

    /**
     * Update the specified Parlay in storage.
     * PUT/PATCH /parlays/{id}
     */
    public function update($id, UpdateParlayAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Parlay $parlay */
        $parlay = $this->parlayRepository->find($id);

        if (empty($parlay)) {
            return $this->sendError('Parlay not found');
        }

        $parlay = $this->parlayRepository->update($input, $id);

        return $this->sendResponse($parlay->toArray(), 'Parlay updated successfully');
    }

    /**
     * Remove the specified Parlay from storage.
     * DELETE /parlays/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Parlay $parlay */
        $parlay = $this->parlayRepository->find($id);

        if (empty($parlay)) {
            return $this->sendError('Parlay not found');
        }

        $parlay->delete();

        return $this->sendSuccess('Parlay deleted successfully');
    }
}
