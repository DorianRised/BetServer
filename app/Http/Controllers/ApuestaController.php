<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApuestaRequest;
use App\Http\Requests\UpdateApuestaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ApuestaRepository;
use Illuminate\Http\Request;
use App\Models\Apuesta;
use Flash;

class ApuestaController extends AppBaseController
{
    /** @var ApuestaRepository $apuestaRepository*/
    private $apuestaRepository;

    public function __construct(ApuestaRepository $apuestaRepo)
    {
        $this->apuestaRepository = $apuestaRepo;
    }

    /**
     * Display a listing of the Apuesta.
     */
    public function index(Request $request)
    {
        // $apuestas = $this->apuestaRepository->paginate(10);

        $apuestas = $this->apuestaRepository->all();


        return view('apuestas.index')
            ->with('apuestas', $apuestas);
    }

    /**
     * Show the form for creating a new Apuesta.
     */
    public function create()
    {
        return view('apuestas.create');
    }

    /**
     * Store a newly created Apuesta in storage.
     */
    public function store(CreateApuestaRequest $request)
    {
        // $validatedData = $request->validate([
        //     'fecha_evento' => 'required|date',
        //     'tipster' => 'required|string|max:100',
        //     'grupo' => 'nullable|string|max:100',
        //     'tipo' => 'required|string|in:Simple,Combinada,Parlay',
        //     'evento' => 'required|string|max:255',
        //     'apuesta' => 'required|string|max:255',
        //     'tipo_apuesta' => 'required|string|in:1X2,Handicap,Over/Under,Goles,Corner',
        //     'monto' => 'required|numeric|min:0.01',
        //     'cuota' => 'required|numeric|min:1',
        //     'ganancia_total' => 'nullable|numeric|min:0',
        //     'liga' => 'required|string|max:100',
        //     'deporte' => 'required|string|in:Fútbol,Tenis,Baloncesto,Béisbol,Hockey',
        //     'parlay_id' => 'nullable|string|max:50',
        //     'resultado' => 'required|string|in:Pendiente,Ganada,Perdida,Nula'
        // ]);

        $validatedData = $request->all();

        try {
            // Crear nueva instancia de Apuesta
            $apuesta = new Apuesta();
            
            // Asignar cada campo individualmente
            $apuesta->fecha_evento = $validatedData['fecha_evento'];
            $apuesta->tipster = $validatedData['tipster'];
            $apuesta->grupo = $validatedData['grupo'] ?? null;
            $apuesta->tipo = $validatedData['tipo'];
            $apuesta->evento = $validatedData['evento'];
            $apuesta->apuesta = $validatedData['apuesta'];
            $apuesta->tipo_apuesta = $validatedData['tipo_apuesta'];
            $apuesta->monto = $validatedData['monto'];
            $apuesta->cuota = $validatedData['cuota'];
            $apuesta->ganancia_total = $validatedData['ganancia_total'] ?? ($validatedData['monto'] * $validatedData['cuota']);
            $apuesta->liga = $validatedData['liga'];
            $apuesta->deporte = $validatedData['deporte'];
            $apuesta->parlay_id = $validatedData['parlay_id'] ?? null;
            $apuesta->resultado = $validatedData['resultado'];
            
            // Asignar el usuario autenticado (si aplica)
            if (auth()->check()) {
                $apuesta->user_id = auth()->id();
            }
            
            // Guardar en la base de datos
            $apuesta->save();
            
            // Redireccionar con mensaje de éxito
            return redirect()->route('apuestas.index')
                ->with('success', 'Apuesta creada exitosamente!');
                
        } catch (\Exception $e) {
            dd($e);
            // Manejar errores y redireccionar con mensaje de error
            return back()->withInput()
                ->with('error', 'Error al crear la apuesta: '.$e->getMessage());
        }
    

        Flash::success('Apuesta creada correctamente.');

        return redirect(route('apuestas.index'));
    }

    /**
     * Display the specified Apuesta.
     */
    public function show($id)
    {
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            Flash::error('Apuesta not found');

            return redirect(route('apuestas.index'));
        }

        return view('apuestas.show')->with('apuesta', $apuesta);
    }

    /**
     * Show the form for editing the specified Apuesta.
     */
    public function edit($id)
    {
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            Flash::error('Apuesta not found');

            return redirect(route('apuestas.index'));
        }

        return view('apuestas.edit')->with('apuesta', $apuesta);
    }

    /**
     * Update the specified Apuesta in storage.
     */
    public function update($id, UpdateApuestaRequest $request)
    {
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            Flash::error('Apuesta not found');

            return redirect(route('apuestas.index'));
        }

        $apuesta = $this->apuestaRepository->update($request->all(), $id);

        Flash::success('Apuesta updated successfully.');

        return redirect(route('apuestas.index'));
    }

    /**
     * Remove the specified Apuesta from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $apuesta = $this->apuestaRepository->find($id);

        if (empty($apuesta)) {
            Flash::error('Apuesta not found');

            return redirect(route('apuestas.index'));
        }

        $this->apuestaRepository->delete($id);

        Flash::success('Apuesta deleted successfully.');

        return redirect(route('apuestas.index'));
    }
}
