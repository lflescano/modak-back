<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Returns the routes for the api
     *
     */
    public function routes()
    {
        $routes = [
            'version' => env('APP_NAME', 'None')
        ];
        if (app()->environment('local')) {
            $collectedRoutes = collect(\Route::getRoutes());
            $routes[] = $collectedRoutes->pluck('uri');
        }
        return response()->json($routes);
    }
}
