<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateResultadoAPIRequest;
use App\Http\Requests\API\UpdateResultadoAPIRequest;
use App\Models\Resultado;
use App\Repositories\ResultadoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ResultadoAPIController
 */
class ResultadoAPIController extends AppBaseController
{
    private ResultadoRepository $resultadoRepository;

    public function __construct(ResultadoRepository $resultadoRepo)
    {
        $this->resultadoRepository = $resultadoRepo;
    }

    /**
     * Display a listing of the Resultados.
     * GET|HEAD /resultados
     */
    public function index(Request $request): JsonResponse
    {
        $resultados = $this->resultadoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($resultados->toArray(), 'Resultados retrieved successfully');
    }

    /**
     * Store a newly created Resultado in storage.
     * POST /resultados
     */
    public function store(CreateResultadoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $resultado = $this->resultadoRepository->create($input);

        return $this->sendResponse($resultado->toArray(), 'Resultado saved successfully');
    }

    /**
     * Display the specified Resultado.
     * GET|HEAD /resultados/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Resultado $resultado */
        $resultado = $this->resultadoRepository->find($id);

        if (empty($resultado)) {
            return $this->sendError('Resultado not found');
        }

        return $this->sendResponse($resultado->toArray(), 'Resultado retrieved successfully');
    }

    /**
     * Update the specified Resultado in storage.
     * PUT/PATCH /resultados/{id}
     */
    public function update($id, UpdateResultadoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Resultado $resultado */
        $resultado = $this->resultadoRepository->find($id);

        if (empty($resultado)) {
            return $this->sendError('Resultado not found');
        }

        $resultado = $this->resultadoRepository->update($input, $id);

        return $this->sendResponse($resultado->toArray(), 'Resultado updated successfully');
    }

    /**
     * Remove the specified Resultado from storage.
     * DELETE /resultados/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Resultado $resultado */
        $resultado = $this->resultadoRepository->find($id);

        if (empty($resultado)) {
            return $this->sendError('Resultado not found');
        }

        $resultado->delete();

        return $this->sendSuccess('Resultado deleted successfully');
    }
}
