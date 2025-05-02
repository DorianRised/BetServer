<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParlayRequest;
use App\Http\Requests\UpdateParlayRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ParlayRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Parlay;
use App\Models\User;
use App\Models\Tipster;

class ParlayController extends AppBaseController
{
    /** @var ParlayRepository $parlayRepository*/
    private $parlayRepository;

    public function __construct(ParlayRepository $parlayRepo)
    {
        $this->parlayRepository = $parlayRepo;
    }

    /**
     * Display a listing of the Parlay.
     */
    public function index(Request $request)
    {
        // $parlays = $this->parlayRepository->paginate(10);

        $parlays = Parlay::with('apuestas')->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('parlays.index')
            ->with('parlays', $parlays);
    }

    /**
     * Show the form for creating a new Parlay.
     */
    public function create()
    {
        $users = User::all();
        $tipsters = Tipster::all();
        return view('parlays.create', compact('users', 'tipsters'));
    }

    /**
     * Store a newly created Parlay in storage.
     */
    public function store(CreateParlayRequest $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tipster_id' => 'required|exists:tipsters,id',
            'nombre' => 'required|string|max:255',
        ]);

        $parlay = Parlay::create([
            'user_id' => $validated['user_id'],
            'tipster_id' => $validated['tipster_id'],
            'nombre' => $validated['nombre'],
            'estado' => 'pendiente',
        ]);

        Flash::success('Parlay creado correctamente.');

        return redirect(route('parlays.index'));
    }

    /**
     * Display the specified Parlay.
     */
    public function show($id)
    {
        $parlay = $this->parlayRepository->find($id);

        if (empty($parlay)) {
            Flash::error('Parlay not found');

            return redirect(route('parlays.index'));
        }

        return view('parlays.show')->with('parlay', $parlay);
    }

    /**
     * Show the form for editing the specified Parlay.
     */
    public function edit($id)
    {
        $parlay = $this->parlayRepository->find($id);
        $users = User::all();
        $tipsters = Tipster::all();

        if (empty($parlay)) {
            Flash::error('Parlay not found');

            return redirect(route('parlays.index'));
        }

        return view('parlays.edit')->with('parlay', $parlay)->with('users', $users)->with('tipsters', $tipsters);
    }

    /**
     * Update the specified Parlay in storage.
     */
    public function update($id, UpdateParlayRequest $request)
    {
        $parlay = $this->parlayRepository->find($id);

        if (empty($parlay)) {
            Flash::error('Parlay not found');

            return redirect(route('parlays.index'));
        }

        $parlay = $this->parlayRepository->update($request->all(), $id);

        Flash::success('Parlay updated successfully.');

        return redirect(route('parlays.index'));
    }

    /**
     * Remove the specified Parlay from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $parlay = $this->parlayRepository->find($id);

        if (empty($parlay)) {
            Flash::error('Parlay not found');

            return redirect(route('parlays.index'));
        }

        $this->parlayRepository->delete($id);

        Flash::success('Parlay deleted successfully.');

        return redirect(route('parlays.index'));
    }
}
