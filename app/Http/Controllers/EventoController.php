<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EventoRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Liga;
use App\Models\Deporte;
use App\Models\Evento;

class EventoController extends AppBaseController
{
    /** @var EventoRepository $eventoRepository*/
    private $eventoRepository;

    public function __construct(EventoRepository $eventoRepo)
    {
        $this->eventoRepository = $eventoRepo;
    }

    /**
     * Display a listing of the Evento.
     */
    public function index(Request $request)
    {
        $eventos = $this->eventoRepository->paginate(10);

        return view('eventos.index')
            ->with('eventos', $eventos);
    }

    /**
     * Show the form for creating a new Evento.
     */
    public function create()
    {
        $deportes = Deporte::all();
        return view('eventos.create', compact('deportes'));
    }

    /**
     * Store a newly created Evento in storage.
     */
    public function store(CreateEventoRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'liga_id' => 'required|exists:ligas,id',
            'deporte_id' => 'required|exists:deportes,id',
            'fecha' => 'required|date',
            'equipo_local_id' => 'required|exists:equipos,id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
        ]);
    
        Evento::create($validated);

        Flash::success('Evento guardado satisfactoriamente.');

        return redirect(route('eventos.index'));
    }

    /**
     * Display the specified Evento.
     */
    public function show($id)
    {
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');

            return redirect(route('eventos.index'));
        }

        return view('eventos.show')->with('evento', $evento);
    }

    /**
     * Show the form for editing the specified Evento.
     */
    public function edit($id)
    {
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');

            return redirect(route('eventos.index'));
        }

        return view('eventos.edit')->with('evento', $evento);
    }

    /**
     * Update the specified Evento in storage.
     */
    public function update($id, UpdateEventoRequest $request)
    {
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');

            return redirect(route('eventos.index'));
        }

        $evento = $this->eventoRepository->update($request->all(), $id);

        Flash::success('Evento actualizado satisfactoriamente.');

        return redirect(route('eventos.index'));
    }

    /**
     * Remove the specified Evento from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $evento = $this->eventoRepository->find($id);

        if (empty($evento)) {
            Flash::error('Evento no encontrado');

            return redirect(route('eventos.index'));
        }

        $this->eventoRepository->delete($id);

        Flash::success('Evento eliminado satisfactoriamente.');

        return redirect(route('eventos.index'));
    }
}
