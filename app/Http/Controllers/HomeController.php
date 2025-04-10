<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Muestra la página de inicio.
     *
     * @return \Illuminate\View\View
     */
    public function indexAdmin()
    {
        $data = [
            'title' => 'Bienvenido a nuestra aplicación',
            'features' => ['Feature 1', 'Feature 2', 'Feature 3']
        ];

        return view('home', $data);
    }
}