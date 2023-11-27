<?php
namespace App\Domains\Users;

class MicrosoftHelper
{
    public static function getImage(string $token): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => 'https://graph.microsoft.com/v1.0/me/photos/48x48/$value',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                "authorization: Bearer $token",
                'cache-control: no-cache',
                'postman-token: 2d4b85a3-5490-3f58-ff74-52e0a98286ec',
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo 'cURL Error #:' . $err;
        } else {
            return base64_encode($response);
        }
    }
}
