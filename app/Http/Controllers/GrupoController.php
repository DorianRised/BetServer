<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGrupoRequest;
use App\Http\Requests\UpdateGrupoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\GrupoRepository;
use Illuminate\Http\Request;
use Flash;

class GrupoController extends AppBaseController
{
    /** @var GrupoRepository $grupoRepository*/
    private $grupoRepository;

    public function __construct(GrupoRepository $grupoRepo)
    {
        $this->grupoRepository = $grupoRepo;
    }

    /**
     * Display a listing of the Grupo.
     */
    public function index(Request $request)
    {
        $grupos = $this->grupoRepository->paginate(10);

        return view('grupos.index')
            ->with('grupos', $grupos);
    }

    /**
     * Show the form for creating a new Grupo.
     */
    public function create()
    {
        return view('grupos.create');
    }

    /**
     * Store a newly created Grupo in storage.
     */
    public function store(CreateGrupoRequest $request)
    {
        $input = $request->all();

        $grupo = $this->grupoRepository->create($input);

        Flash::success('Grupo saved successfully.');

        return redirect(route('grupos.index'));
    }

    /**
     * Display the specified Grupo.
     */
    public function show($id)
    {
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            Flash::error('Grupo not found');

            return redirect(route('grupos.index'));
        }

        return view('grupos.show')->with('grupo', $grupo);
    }

    /**
     * Show the form for editing the specified Grupo.
     */
    public function edit($id)
    {
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            Flash::error('Grupo not found');

            return redirect(route('grupos.index'));
        }

        return view('grupos.edit')->with('grupo', $grupo);
    }

    /**
     * Update the specified Grupo in storage.
     */
    public function update($id, UpdateGrupoRequest $request)
    {
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            Flash::error('Grupo not found');

            return redirect(route('grupos.index'));
        }

        $grupo = $this->grupoRepository->update($request->all(), $id);

        Flash::success('Grupo updated successfully.');

        return redirect(route('grupos.index'));
    }

    /**
     * Remove the specified Grupo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $grupo = $this->grupoRepository->find($id);

        if (empty($grupo)) {
            Flash::error('Grupo not found');

            return redirect(route('grupos.index'));
        }

        $this->grupoRepository->delete($id);

        Flash::success('Grupo deleted successfully.');

        return redirect(route('grupos.index'));
    }
}
