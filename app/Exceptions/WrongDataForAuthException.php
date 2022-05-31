<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class WrongDataForAuthException extends Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 422, Throwable $previous = null)
    {
        $message = empty($message) ? trans('auth.failed') : $message;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Отрисовка ошибки
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return \response()->json([
            'message' => $this->message,
        ], $this->code);
    }
}
