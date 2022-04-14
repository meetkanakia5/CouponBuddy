<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */

    protected $except = [
        'http://localhost:8000/logout',
        'https://localhost:8000/logout',
        'http://localhost:8000/add-to-cart',
        'http://localhost:8000/admin/sub-category-direction-delete',
    ];
    
}
