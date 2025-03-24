<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AppBaseController extends BaseController
{
    // Aquí puedes agregar métodos comunes para tus controladores,
    // como manejo de respuestas o validaciones generales.

    // Método para devolver respuestas JSON estándar
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response);
    }

    // Método para devolver errores JSON estándar
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'data'    => $errorMessages,
        ];

        return response()->json($response, $code);
    }
}
