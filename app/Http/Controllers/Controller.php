<?php

namespace App\Http\Controllers;

class Controller
{
    public function sendResponse($message, $data = null)
    {
        $response = [
            'code' => 200,
            'status' => "success",
            'message' => $message,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }

    ///////////////////////////////////////////////////////////////////

    public function sendError($message)
    {
        $response = [
            'code' => 400,
            'status' => "failed",
            'message' => $message,
        ];
        return response()->json($response);
    }

    ///////////////////////////////////////////////////////////////////

    public function sendNoDataResponse($message, $data = null)
    {
        $response = [
            'code' => 404,
            'status' => "No Data Exist",
            'message' => $message,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }
}