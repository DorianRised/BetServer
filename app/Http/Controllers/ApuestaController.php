<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApuestaRequest;
use App\Http\Requests\UpdateApuestaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ApuestaRepository;
use Illuminate\Http\Request;
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
        $apuestas = $this->apuestaRepository->paginate(10);

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
        $input = $request->all();

        $apuesta = $this->apuestaRepository->create($input);

        Flash::success('Apuesta saved successfully.');

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
