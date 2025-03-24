<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLigaRequest;
use App\Http\Requests\UpdateLigaRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\LigaRepository;
use Illuminate\Http\Request;
use Flash;

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
        return view('ligas.create');
    }

    /**
     * Store a newly created Liga in storage.
     */
    public function store(CreateLigaRequest $request)
    {
        $input = $request->all();

        $liga = $this->ligaRepository->create($input);

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

        return view('ligas.edit')->with('liga', $liga);
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

        $liga = $this->ligaRepository->update($request->all(), $id);

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
}
