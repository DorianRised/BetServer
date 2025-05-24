<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEventoAPIRequest;
use App\Http\Requests\API\UpdateEventoAPIRequest;
use App\Models\Evento;
use App\Repositories\EventoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Liga;
use App\Models\Equipo;

/**
 * Class EventoAPIController
 */
class EventoAPIController extends AppBaseController
{
    private EventoRepository $eventoRepository;

    public function __construct(EventoRepository $eventoRepo)
    {
        $this->eventoRepository = $eventoRepo;
    }

    /**
     * Display a listing of the Eventos.
     * GET|HEAD /eventos
     */
    public function index(Request $request): JsonResponse
    {
        $eventos = $this->eventoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($eventos->toArray(), 'Eventos retrieved successfully');
    }

    /**
     * Store a newly created Evento in storage.
     * POST /eventos
     */
    public function store(CreateEventoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $evento = $this->eventoRepository->create($input);

        return $this->sendResponse($evento->toArray(), 'Evento saved successfully');
    }

    /**
     * Display the specified Evento.
     * GET|HEAD /eventos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Evento $evento */
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found');
        }

        return $this->sendResponse($evento->toArray(), 'Evento retrieved successfully');
    }

    /**
     * Update the specified Evento in storage.
     * PUT/PATCH /eventos/{id}
     */
    public function update($id, UpdateEventoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Evento $evento */
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found');
        }

        $evento = $this->eventoRepository->update($input, $id);

        return $this->sendResponse($evento->toArray(), 'Evento updated successfully');
    }

    /**
     * Remove the specified Evento from storage.
     * DELETE /eventos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Evento $evento */
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found');
        }

        $evento->delete();

        return $this->sendSuccess('Evento deleted successfully');
    }

    public function ligasPorDeporte($deporteId)
    {
        $ligas = Liga::where('deporte_id', $deporteId)->get();
        return response()->json($ligas);
    }

    public function equiposPorDeporte($deporteId)
    {
        $ligas = Equipo::where('deporte_id', $deporteId)->get();
        return response()->json($ligas);
    }
}
