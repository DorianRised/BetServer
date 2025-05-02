<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLigaRequest;
use App\Http\Requests\UpdateLigaRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Deporte;
use App\Repositories\LigaRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use App\Models\Liga;
use App\Models\Evento;
use Carbon\Carbon;

class LigaController extends AppBaseController
{
    /** @var LigaRepository $ligaRepository*/
    private $ligaRepository;

    public function __construct(LigaRepository $ligaRepo)
    {
        $this->ligaRepository = $ligaRepo;
    }

    /**
     * Display a listing of the Liga.
     */
    public function index(Request $request)
    {
        $ligas = $this->ligaRepository->paginate(10);

        return view('ligas.index')
            ->with('ligas', $ligas);
    }

    /**
     * Show the form for creating a new Liga.
     */
    public function create()
    {
        $deportes = Deporte::all();
        return view('ligas.create', compact('deportes'));
    }

    /**
     * Store a newly created Liga in storage.
     */
    public function store(CreateLigaRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'pais' => 'required|string|max:50',
            'img_liga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'deporte_id' => 'required|exists:deportes,id',
        ]);

        if ($request->hasFile('img_liga')) {
            $validated['img_liga'] = $request->file('img_liga')->store('ligas', 'public');
        }

        Liga::create($validated);

        Flash::success('Liga saved successfully.');

        return redirect(route('ligas.index'));
    }

    /**
     * Display the specified Liga.
     */
    public function show($id)
    {
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            Flash::error('Liga not found');

            return redirect(route('ligas.index'));
        }

        return view('ligas.show')->with('liga', $liga);
    }

    /**
     * Show the form for editing the specified Liga.
     */
    public function edit($id)
    {
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            Flash::error('Liga not found');

            return redirect(route('ligas.index'));
        }

        $deportes = Deporte::all();
        return view('ligas.edit', compact('liga', 'deportes'));
    }

    /**
     * Update the specified Liga in storage.
     */
    public function update($id, UpdateLigaRequest $request)
    {
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            Flash::error('Liga not found');

            return redirect(route('ligas.index'));
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'pais' => 'required|string|max:50',
            'img_liga' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deporte_id' => 'required|exists:deportes,id',
        ]);

        if ($request->hasFile('img_liga')) {
            // Eliminar imagen anterior si existe
            if ($liga->img_liga) {
                Storage::disk('public')->delete($liga->img_liga);
            }
            $validated['img_liga'] = $request->file('img_liga')->store('ligas', 'public');
        }

        $liga->update($validated);

        Flash::success('Liga updated successfully.');

        return redirect(route('ligas.index'));
    }

    /**
     * Remove the specified Liga from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $liga = $this->ligaRepository->find($id);

        if (empty($liga)) {
            Flash::error('Liga not found');

            return redirect(route('ligas.index'));
        }

        $this->ligaRepository->delete($id);

        Flash::success('Liga deleted successfully.');

        return redirect(route('ligas.index'));
    }

    public function eventosPorLiga($ligaId)
    {
        $eventos = Evento::where('liga_id', $ligaId)
                        ->orderBy('fecha_evento', 'asc')
                        ->get(['id', 'nombre', 'fecha_evento']);

        // Formatear los eventos para incluir la fecha legible
        $eventosFormateados = $eventos->map(function ($evento) {
            return [
                'id' => $evento->id,
                'nombre' => $evento->nombre,
                'fecha_evento' => Carbon::parse($evento->fecha_evento)->format('Y-m-d H:i'),
                'fecha_legible' => Carbon::parse($evento->fecha_evento)->format('d/m/Y H:i')
            ];
        });

        return response()->json($eventosFormateados);
    }
}
