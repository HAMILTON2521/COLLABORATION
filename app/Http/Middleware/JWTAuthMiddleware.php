<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\Response;

class JWTAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $jwt = $request->header('Authorization');

        if (!$jwt) {
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'Invalid token');

            $xmlStringWithoutDeclaration = preg_replace('/<\?xml.*?\?>\n?/', '', $responseXml->asXML());

            return response($xmlStringWithoutDeclaration, 400)
                ->header('Content-Type', 'application/xml');
        }

        $key = Setting::where('key', 'JWT_AIRTEL_SECRET')->first()->value;

        try {
            $decoded = JWT::decode($jwt, new Key($key, 'HS512'));
            $request->attributes->set('jwt_payload', (array) $decoded);

            return $next($request);
        } catch (\Exception $e) {
            $responseXml = new SimpleXMLElement('<COMMAND/>');
            $responseXml->addChild('STATUS', '400');
            $responseXml->addChild('MESSAGE', 'Invalid token');

            $xmlStringWithoutDeclaration = preg_replace('/<\?xml.*?\?>\n?/', '', $responseXml->asXML());

            return response($xmlStringWithoutDeclaration, 400)
                ->header('Content-Type', 'application/xml');
        }
    }
}
