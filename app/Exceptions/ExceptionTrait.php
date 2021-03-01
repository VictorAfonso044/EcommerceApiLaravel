<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * 
 */
trait ExceptionTrait
{
    public function apiException($request, Exception $exception)
    {
        if ($this->isModel($exception)) {

            return $this->modelResponse($exception);

        }

        if ($this->isHttp($exception)) {

            return $this->httpResponse($exception);

        }

        return parent::render($request, $exception);
    }

    protected function isModel(Exception $exception)
    {
        return $exception instanceof ModelNotFoundException;
    }

    protected function isHttp(Exception $exception)
    {
        return $exception instanceof NotFoundHttpException;
    }

    protected function modelResponse(Exception $exception)
    {
        return response()->json([
            'errors' => 'Product not found'
        ], Response::HTTP_NOT_FOUND);
    }
    
    protected function httpResponse(Exception $exception)
    {
        return response()->json([
            'errors' => 'Incorect path'
        ], Response::HTTP_NOT_FOUND);
    }
}
