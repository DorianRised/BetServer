<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParlayRequest;
use App\Http\Requests\UpdateParlayRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ParlayRepository;
use Illuminate\Http\Request;
use Flash;

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
        $parlays = $this->parlayRepository->paginate(10);

        return view('parlays.index')
            ->with('parlays', $parlays);
    }

    /**
     * Show the form for creating a new Parlay.
     */
    public function create()
    {
        return view('parlays.create');
    }

    /**
     * Store a newly created Parlay in storage.
     */
    public function store(CreateParlayRequest $request)
    {
        $input = $request->all();

        $parlay = $this->parlayRepository->create($input);

        Flash::success('Parlay saved successfully.');

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

        if (empty($parlay)) {
            Flash::error('Parlay not found');

            return redirect(route('parlays.index'));
        }

        return view('parlays.edit')->with('parlay', $parlay);
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
