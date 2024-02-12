<?php

if (!function_exists('api_response')) {
    function api_response($data = null, $status = 200, $message = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message ?? 'success',
            'data' => $data,
        ], $status);
    }
}
