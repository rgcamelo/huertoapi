<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if($e instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($e,$request);
        }

        if($e instanceof ModelNotFoundException){
            $model = strtolower(class_basename($e->getModel()));
            return $this->errorResponse("No existe ninguna instancia de {$model} con el id especificado",404);
        }

        if($e instanceof AuthenticationException){
            return $this->unauthenticated($request,$e);
        }

        if($e instanceof AuthorizationException){
            return $this->errorResponse('No posee permisos para ejecutar esta accion',403);
        }

        if($e instanceof NotFoundHttpException){
            return $this->errorResponse('No se encontro la URL especificadad',404);
        }

        if($e instanceof MethodNotAllowedHttpException){
            return $this->errorResponse('El metodo especificado en la peticion no es valido',405);
        }

        if($e instanceof HttpException){
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        }

        if($e instanceof QueryException){
            $code = $e->errorInfo[1];
            if($code == 1451){
                return $this->errorResponse('No se puede eliminar de forma permanente el recurso debido a que esta relacionado con algun otro',409);
            }
        }

        if (config('app.debug')) {
            return parent::render($request,$e);
        }

        return $this->errorResponse('Falla Inesperada, Intente Luego',500);



    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request){
        return $this->invalidJson($request,$e);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return $this->errorResponse($exception->errors(),$exception->status);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('No autenticado',401);
    }




}
