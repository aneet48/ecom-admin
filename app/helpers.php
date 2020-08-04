<?php

if (!function_exists('generate_response')) {
    /**
     * Returns a human readable file size
     *
     * @param integer $bytes
     * Bytes contains the size of the bytes to convert
     *
     * @param integer $decimals
     * Number of decimal places to be returned
     *
     * @return string a string in human readable format
     *
     * */
    function generate_response($error, $msg, $body = null)
    {
        $response = [
            'error' => $error,
            'msg' => $msg,
            'body' => $body,
        ];
        return response()->json($response);

    }
}
