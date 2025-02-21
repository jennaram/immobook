<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | Here you can register your custom route middleware.
    |
    */

    'is_admin' => \App\Http\Middleware\IsAdmin::class,
    
    // Vous pouvez ajouter d'autres middlewares ici
];