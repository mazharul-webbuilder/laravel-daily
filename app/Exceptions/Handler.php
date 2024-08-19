<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AccessDeniedHttpException  $exception){
            return response()->json([
                'status' => false,
                'message' => 'You are trying to action on someone else data',
                'data' => null,
                'errors' => $exception->getMessage()
            ], Response::HTTP_FORBIDDEN);
        });

        // Please check Policy_Single_and_Multi_auth.md, AuthServiceProvider.php and PolicyController.php to get details






        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
