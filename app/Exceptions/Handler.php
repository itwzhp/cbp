<?php
namespace App\Exceptions;

use App\Domains\Users\Exceptions\UnauthorizedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected array $renderable = [
        UnauthorizedException::class,
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $throwable, Request $request) {
            if (in_array(get_class($throwable), $this->renderable)) {
                if ($request->is('api/*')) {
                    return response()->json([
                        $throwable->getMessage(),
                    ], $throwable->getCode());
                }

                flash($throwable->getMessage());

                return back();
            }
        });
    }
}
