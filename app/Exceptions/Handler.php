<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // public function render($request, $exception)
    // {
        
    //     // بررسی اگر خطا از نوع HTTP باشد
    //     if ($exception instanceof HttpExceptionInterface) {
    //         $code = $exception->getStatusCode();
    //         $title = $this->getErrorTitle($code);
    //         $description = $this->getErrorDescription($code);

    //         return response()->view('error', [
    //             'errorCode' => $code,
    //             'title' => $title,
    //             'description' => $description,
    //         ], $code);
    //     }

    //     // برای خطاهای غیر HTTP (مثل خطاهای سرور 500)
    //     return response()->view('error', [
    //         'errorCode' => 500,
    //         'title' => 'خطای سرور',
    //         'description' => 'متأسفیم، مشکلی در سرور رخ داده است. لطفاً بعداً تلاش کنید.'
    //     ], 500);
    // }

    
    private function getErrorTitle($code): string
    {
        return match ($code) {
            400 => 'درخواست نامعتبر',
            401 => 'عدم دسترسی',
            403 => 'دسترسی غیرمجاز',
            404 => 'صفحه موردنظر یافت نشد',
            429 => 'تعداد درخواست‌ها بیش از حد',
            500 => 'خطای سرور',
            default => 'خطایی رخ داده است',
        };
    }

    
    private function getErrorDescription($code): string
    {
        return match ($code) {
            400 => 'درخواست شما نامعتبر است. لطفاً بررسی کنید.',
            401 => 'برای دسترسی به این صفحه باید وارد شوید.',
            403 => 'شما اجازه دسترسی به این صفحه را ندارید.',
            404 => 'صفحه مورد نظر بافت نشد',
            429 => 'تعداد درخواست‌های شما بیش از حد مجاز است.',
            500 => 'متأسفیم، مشکلی در سرور رخ داده است.',
            default => 'خطایی رخ داده است. لطفاً بعداً تلاش کنید.',
        };
    }
}
