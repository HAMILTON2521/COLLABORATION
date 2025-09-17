<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class SelcomMerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $check = Setting::where(['key' => 'SELCOM_MERCHANT_TOKEN', 'value' => $token])->exists();

        if (!$check) {
            return response()->json([
                'reference' => $request['reference'],
                'resultcode' => 401,
                'result' => 'FAILED',
                'message' => 'Invalid bearer token'
            ], 401);
        }

        return $next($request);
    }
}
