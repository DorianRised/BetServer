<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTipsterRequest;
use App\Http\Requests\UpdateTipsterRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\TipsterRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use App\Models\Tipster;
use App\Models\Grupo;
use App\Models\User;

class TipsterController extends AppBaseController
{
    /** @var TipsterRepository $tipsterRepository*/
    private $tipsterRepository;

    public function __construct(TipsterRepository $tipsterRepo)
    {
        $this->tipsterRepository = $tipsterRepo;
    }

    /**
     * Display a listing of the Tipster.
     */
    public function index(Request $request)
    {
        $tipsters = $this->tipsterRepository->paginate(10);

        return view('tipsters.index')
            ->with('tipsters', $tipsters);
    }

    /**
     * Show the form for creating a new Tipster.
     */
    public function create()
    {
        $grupos = Grupo::orderBy('nombre', 'asc')->get(['id', 'nombre']);
        $users = User::orderBy('name', 'asc')->get(['id', 'name']);
        return view('tipsters.create', compact('grupos', 'users'));
    }

    /**
     * Store a newly created Tipster in storage.
     */
    public function store(CreateTipsterRequest $request)
    {
        $input = $request->all();

        $tipster = $this->tipsterRepository->create($input);

        Flash::success('Tipster saved successfully.');

        return redirect(route('tipsters.index'));
    }

    /**
     * Display the specified Tipster.
     */
    public function show($id)
    {
        $tipster = $this->tipsterRepository->find($id);

        if (empty($tipster)) {
            Flash::error('Tipster not found');

            return redirect(route('tipsters.index'));
        }

        return view('tipsters.show')->with('tipster', $tipster);
    }

    /**
     * Show the form for editing the specified Tipster.
     */
    public function edit($id)
    {
        $tipster = $this->tipsterRepository->find($id);
        $grupos = Grupo::orderBy('nombre', 'asc')->get(['id', 'nombre']);
        $users = User::orderBy('name', 'asc')->get(['id', 'name']);

        if (empty($tipster)) {
            Flash::error('Tipster not found');

            return redirect(route('tipsters.index'));
        }

        return view('tipsters.edit')->with('tipster', $tipster)->with('grupos', $grupos)->with('users', $users);
    }

    /**
     * Update the specified Tipster in storage.
     */
    public function update($id, UpdateTipsterRequest $request)
    {
        $tipster = $this->tipsterRepository->find($id);

        if (empty($tipster)) {
            Flash::error('Tipster not found');

            return redirect(route('tipsters.index'));
        }

        $tipster = $this->tipsterRepository->update($request->all(), $id);

        Flash::success('Tipster updated successfully.');

        return redirect(route('tipsters.index'));
    }

    /**
     * Remove the specified Tipster from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipster = $this->tipsterRepository->find($id);

        if (empty($tipster)) {
            Flash::error('Tipster not found');

            return redirect(route('tipsters.index'));
        }

        $this->tipsterRepository->delete($id);

        Flash::success('Tipster deleted successfully.');

        return redirect(route('tipsters.index'));
    }

}
