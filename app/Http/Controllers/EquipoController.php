<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EquipoRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Deporte;
use App\Models\Equipo;

class EquipoController extends AppBaseController
{
    /** @var EquipoRepository $equipoRepository*/
    private $equipoRepository;

    public function __construct(EquipoRepository $equipoRepo)
    {
        $this->equipoRepository = $equipoRepo;
    }

    /**
     * Display a listing of the Equipo.
     */
    public function index(Request $request)
    {
        $equipos = $this->equipoRepository->paginate(10);

        return view('equipos.index')
            ->with('equipos', $equipos);
    }

    /**
     * Show the form for creating a new Equipo.
     */
    public function create()
    {
        $deportes = Deporte::all();
        $categorias = ['Amateur', 'Profesional', 'Semiprofesional', 'Juvenil'];
        $paises = ['Argentina', 'Brasil', 'Chile', 'Colombia', 'España', 'México', 'Perú', 'Uruguay', 'Otro'];
        return view('equipos.create', compact('deportes', 'categorias', 'paises'));
    }

    /**
     * Store a newly created Equipo in storage.
     */
    public function store(CreateEquipoRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:equipos',
            'deporte_id' => 'required|exists:deportes,id',
            'categoria' => 'required|string|max:50',
            'pais' => 'required|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $equipo = new Equipo();
        $equipo->nombre = $validated['nombre'];
        $equipo->deporte_id = $validated['deporte_id'];
        $equipo->categoria = $validated['categoria'];
        $equipo->pais = $validated['pais'];

        if ($request->hasFile('logo')) {
            $equipo->logo = $request->file('logo')->store('equipos/logos', 'public');
        }

        $equipo->save();
        Flash::success('Equipo creado correctamente.');

        return redirect(route('equipos.index'));
    }

    /**
     * Display the specified Equipo.
     */
    public function show($id)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        return view('equipos.show')->with('equipo', $equipo);
    }

    /**
     * Show the form for editing the specified Equipo.
     */
    public function edit($id)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        return view('equipos.edit')->with('equipo', $equipo);
    }

    /**
     * Update the specified Equipo in storage.
     */
    public function update($id, UpdateEquipoRequest $request)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        $equipo = $this->equipoRepository->update($request->all(), $id);

        Flash::success('Equipo updated successfully.');

        return redirect(route('equipos.index'));
    }

    /**
     * Remove the specified Equipo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $equipo = $this->equipoRepository->find($id);

        if (empty($equipo)) {
            Flash::error('Equipo not found');

            return redirect(route('equipos.index'));
        }

        $this->equipoRepository->delete($id);

        Flash::success('Equipo deleted successfully.');

        return redirect(route('equipos.index'));
    }
}
