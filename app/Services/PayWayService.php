<?php
// app/Services/PayWayService.php

namespace App\Services;

class PayWayService
{
    /**
     * Get the API URL from the configuration.
     *
     * @return string
     */
    public function getApiUrl()
    {
        return config('payway.api_url');
    }

    /**
     * Generate the hash for PayWay security.
     *
     * @param string $str
     * @return string
     */
    public function getHash($str)
    {
        $publicKey = '7290d28610b645f071b3cda939a19f476e9193e1'; // Sandbox Key
        return base64_encode(hash_hmac('sha512', $str, $publicKey, true));
    }
}
