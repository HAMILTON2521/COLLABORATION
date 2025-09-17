<?php

namespace App\Traits;

use App\Models\Setting;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Str;

trait GeneralHelperTrait
{
    public function generateJWTToken(string $uniqueId, string $key, int $jwtExpiryInSeconds, string $sub, $iss)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + $jwtExpiryInSeconds;
        $payload = [
            'jti' => join('_', [config('app.name'), (string) Str::uuid()]), // unique identifier for the JWT
            'iat' => $issuedAt,             // issued at time
            'sub' => $sub,       // subject
            'iss' => $iss,       // issuer
            'payload' => [
                'txnId' => $uniqueId           // transaction ID
            ],
            'exp' => $expirationTime         // expiration time
        ];

        $token = JWT::encode($payload, $key, 'HS512');

        return $token;
    }
    public function decodeJWTToken(string $token, string $key)
    {
        if ($token) {
            try {
                $decoded = JWT::decode($token, new Key($key, 'HS512'));
                return response()->json((array) $decoded);
            } catch (\Exception $e) {
                if ($e->getMessage() == 'Expired token') {
                    return response()->json(status: 401, data: [
                        'message' => $e->getMessage()
                    ]);
                } else if ($e->getMessage() == '') {
                    return response()->json(status: 400, data: [
                        'message' => $e->getMessage()
                    ]);
                } else {
                    return response()->json(status: 404, data: [
                        'message' => $e->getMessage()
                    ]);
                }
            }
        }
        return response()->json(status: 404, data: [
            'message' => 'Token is missing'
        ]);
        ;
    }
    public function createFullReference(string $utilityRef): string
    {
        $prefix = Setting::get('SELCOM_TILL_NUMBER');
        return $prefix . $utilityRef;
    }
}
