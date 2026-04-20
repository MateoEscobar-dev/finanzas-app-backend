<?php

namespace App\Traits;

use App\Models\Instructions;
use Illuminate\Support\Facades\Lang;

trait ApiResponse
{

  protected function successResponse($data, $message = null, $code = 200, $aPagination = false)
  {
    return response([
      'status' => 'Success',
      'message' => $message,
      'data' => $data,
      'pagination' => $aPagination,
      'errors' => null,
      'code' => $code
    ])->setStatusCode($code);
  }

  protected function errorResponse($errorMessages, $errors = [], $code = 404, $trace = [])
  {
    return response()->json([
      'status' => 'Error',
      'message' => $errorMessages,
      'data' => null,
      'errors' => $errors,
      'code' => $code,
      'trace' => $trace
    ], $code);
  }

  protected function infoResponse($errorMessages, $errors)
  {
    return response([
      'status'   => 'Error',
      'message'   => Lang::get('The given data was invalid'),
      'data'      => $errorMessages,
      'errors'      => $errors
    ]);
  }
}
