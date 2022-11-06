<?php

namespace App\Api;

use GuzzleHttp\Client;

class PushNotification
{
    public static function sendNotification($fcm_token, $title, $body, $type)
    {
        $token = $fcm_token;
        $apiKey = "AAAAX_iBaHA:APA91bGYDb2XRe6PgrmkJN1X5gQedSB0XerrW_aQwiQ8dlnXDtRkOpO8-dCua-sLIM9ocaMUpoWI33OBHgTkXU9QQFlpKI_FwMnH15QwNhm_yrI35b3M3GJx8nxnW41FPPJ_aumldfGj";
        // FCM API Url
        $url = 'https://fcm.googleapis.com/fcm/send';

        // Compile headers in one variable
        $headers = array(
            'Authorization:key=' . $apiKey,
            'Content-Type:application/json'
        );

        // Add notification content to a variable for easy reference
        $notifData = [
            'title' => $title,
            'body' => $body,
        ];

        $dataPayload = [
            // 'to' => 'My Name',
            // 'points' => 80,
            // 'other_data' => 'This is extra payload',
            'type' => $type,
        ];

        // Create the api body
        $apiBody = [
            'notification' => $notifData,
            'data' => $dataPayload, //Optional
            'time_to_live' => 600, // optional - In Seconds
            //'to' => '/topics/mytargettopic'
            //'registration_ids' = ID ARRAY
            'to' => $token
        ];

        // Initialize curl with the prepared headers and body
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

        // Execute call and save result
        curl_exec($ch);
        // Close curl after call
        curl_close($ch);
        return 1;
    }
}
