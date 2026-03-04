<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                $modelo = class_basename($e->getModel());
                $id = implode(', ', $e->getIds());
                
                return response()->json([
                    'message' => "No se encontró ningún registro de {$modelo} con el ID: {$id}"
                ], 404);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    $mne = $e->getPrevious();
                    $modelo = class_basename($mne->getModel());
                    $id = implode(', ', $mne->getIds());
                    return response()->json([
                        'message' => "No se encontró ningún registro de {$modelo} con el ID: {$id}"
                    ], 404);
                }

                return response()->json([
                    'message' => 'La ruta o el recurso solicitado no existe.'
                ], 404);
            }
        });
    }
}
