<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipoApuestaRequest;
use App\Http\Requests\UpdateTipoApuestaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TipoApuestaRepository;
use Illuminate\Http\Request;
use App\Models\TipoApuesta;
use Flash;

class TipoApuestaController extends AppBaseController
{
    /** @var TipoApuestaRepository $tipoApuestaRepository*/
    private $tipoApuestaRepository;

    public function __construct(TipoApuestaRepository $tipoApuestaRepo)
    {
        $this->tipoApuestaRepository = $tipoApuestaRepo;
    }

    /**
     * Display a listing of the TipoApuesta.
     */
    public function index(Request $request)
    {
        $tipoApuestas = $this->tipoApuestaRepository->paginate(10);

        return view('tipo_apuestas.index')
            ->with('tipoApuestas', $tipoApuestas);
    }

    /**
     * Show the form for creating a new TipoApuesta.
     */
    public function create()
    {
        return view('tipo_apuestas.create');
    }

    /**
     * Store a newly created TipoApuesta in storage.
     */
    public function store(CreateTipoApuestaRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:tipo_apuestas',
            'codigo' => 'required|string|max:20|unique:tipo_apuestas',
            'descripcion' => 'nullable|string',
        ]);

        TipoApuesta::create($validated);

        Flash::success('Tipo Apuesta saved successfully.');

        return redirect(route('tipo-apuestas.index'));
    }

    /**
     * Display the specified TipoApuesta.
     */
    public function show($id)
    {
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            Flash::error('Tipo Apuesta not found');

            return redirect(route('tipo-apuestas.index'));
        }

        return view('tipo_apuestas.show')->with('tipoApuesta', $tipoApuesta);
    }

    /**
     * Show the form for editing the specified TipoApuesta.
     */
    public function edit($id)
    {
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            Flash::error('Tipo Apuesta not found');

            return redirect(route('tipo-apuestas.index'));
        }

        return view('tipo_apuestas.edit')->with('tipoApuesta', $tipoApuesta);
    }

    /**
     * Update the specified TipoApuesta in storage.
     */
    public function update($id, UpdateTipoApuestaRequest $request)
    {
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            Flash::error('Tipo Apuesta not found');

            return redirect(route('tipo-apuestas.index'));
        }

        $tipoApuesta = $this->tipoApuestaRepository->update($request->all(), $id);

        Flash::success('Tipo Apuesta updated successfully.');

        return redirect(route('tipo-apuestas.index'));
    }

    /**
     * Remove the specified TipoApuesta from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoApuesta = $this->tipoApuestaRepository->find($id);

        if (empty($tipoApuesta)) {
            Flash::error('Tipo Apuesta not found');

            return redirect(route('tipo-apuestas.index'));
        }

        $this->tipoApuestaRepository->delete($id);

        Flash::success('Tipo Apuesta deleted successfully.');

        return redirect(route('tipo-apuestas.index'));
    }
}
