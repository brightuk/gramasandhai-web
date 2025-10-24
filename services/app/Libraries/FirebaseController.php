<?php

namespace App\Libraries;

class FirebaseNotification   // ✅ Renamed from FirebaseController
{
    private $serverKey;

    public function __construct()
    {
        // Put your Firebase Server Key here (From Firebase -> Project Settings -> Cloud Messaging -> Server key)
        $this->serverKey = "AIzaSyBXYJ9878NpEOdhuLaz9orl5QmgZxZpcGo";
    }

    public function sendToDevice($deviceToken, $title, $body, $data = [])
    {
        $url = "https://fcm.googleapis.com/fcm/send";

        $notification = [
            "title" => $title,
            "body"  => $body,
            "sound" => "default"
        ];

        $payload = [
            "to" => $deviceToken,
            "notification" => $notification,
            "data" => $data
        ];

        $headers = [
            "Authorization: key=" . $this->serverKey,
            "Content-Type: application/json"
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => json_encode($payload)
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
