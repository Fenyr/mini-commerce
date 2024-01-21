<?php

namespace App\Helpers;

final class ApiResponse
{
    public static function withdata($message = "success", $status, $data)
    {
        return response()->json(["message" => $message, "data" => $data], $status);
    }
    public static function nodata($message, $status)
    {
        return response()->json(["message" => $message], $status);
    }
}
