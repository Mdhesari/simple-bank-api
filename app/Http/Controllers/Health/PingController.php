<?php

namespace App\Http\Controllers\Health;

use App\Http\Controllers\Controller;
use App\Http\Resources\PingResource;
use Illuminate\Http\Request;

class PingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): PingResource
    {
        return new PingResource([]);
    }
}
