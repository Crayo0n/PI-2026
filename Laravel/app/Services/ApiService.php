<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class ApiService
{
    /**
     * @return PendingRequest
     */
    public static function make()
    {
        return Http::baseUrl(env('FASTAPI_BASE_URL', 'http://api:8000/api/v1'))
            ->timeout(15)
            ->acceptJson();
    }

    public static function get($endpoint, $queryParams = [])
    {
        return self::make()->get($endpoint, $queryParams);
    }

    public static function post($endpoint, $data = [])
    {
        return self::make()->post($endpoint, $data);
    }

    public static function put($endpoint, $data = [])
    {
        return self::make()->put($endpoint, $data);
    }

    public static function delete($endpoint)
    {
        return self::make()->delete($endpoint);
    }
}
