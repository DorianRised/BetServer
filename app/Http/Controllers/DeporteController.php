<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeporteRequest;
use App\Http\Requests\UpdateDeporteRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DeporteRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use App\Models\Deporte;
use App\Models\Liga;

class DeporteController extends AppBaseController
{
    /** @var DeporteRepository $deporteRepository*/
    private $deporteRepository;

    public function __construct(DeporteRepository $deporteRepo)
    {
        $this->deporteRepository = $deporteRepo;
    }

    /**
     * Display a listing of the Deporte.
     */
    public function index(Request $request)
    {
        $deportes = $this->deporteRepository->paginate(10);

        return view('deportes.index')
            ->with('deportes', $deportes);
    }

    /**
     * Show the form for creating a new Deporte.
     */
    public function create()
    {
        return view('deportes.create');
    }

    /**
     * Store a newly created Deporte in storage.
     */
    public function store(CreateDeporteRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50|unique:deportes',
            'img_deporte' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('img_deporte')) {
            $validated['img_deporte'] = $request->file('img_deporte')->store('deportes', 'public');
        }

        Deporte::create($validated);

        Flash::success('Deporte saved successfully.');

        return redirect(route('deportes.index'));
    }

    /**
     * Display the specified Deporte.
     */
    public function show($id)
    {
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            Flash::error('Deporte not found');

            return redirect(route('deportes.index'));
        }

        return view('deportes.show')->with('deporte', $deporte);
    }

    /**
     * Show the form for editing the specified Deporte.
     */
    public function edit($id)
    {
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            Flash::error('Deporte not found');

            return redirect(route('deportes.index'));
        }

        return view('deportes.edit')->with('deporte', $deporte);
    }

    /**
     * Update the specified Deporte in storage.
     */
    public function update($id, UpdateDeporteRequest $request)
    {
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            Flash::error('Deporte not found');

            return redirect(route('deportes.index'));
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:50|unique:deportes,nombre,'.$deporte->id,
            'img_deporte' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('img_deporte')) {
            if ($deporte->img_deporte) {
                Storage::disk('public')->delete($deporte->img_deporte);
            }
            $validated['img_deporte'] = $request->file('img_deporte')->store('deportes', 'public');
        }

        $deporte->update($validated);

        Flash::success('Deporte updated successfully.');

        return redirect(route('deportes.index'));
    }

    /**
     * Remove the specified Deporte from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $deporte = $this->deporteRepository->find($id);

        if (empty($deporte)) {
            Flash::error('Deporte not found');

            return redirect(route('deportes.index'));
        }

        if ($deporte->img_deporte) {
            Storage::disk('public')->delete($deporte->img_deporte);
        }

        $this->deporteRepository->delete($id);

        Flash::success('Deporte deleted successfully.');

        return redirect(route('deportes.index'));
    }

}
