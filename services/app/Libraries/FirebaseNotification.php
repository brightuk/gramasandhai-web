<?php
namespace App\Libraries;

use Google\Client;
use GuzzleHttp\Client as GuzzleClient;

class FirebaseNotification
{
    private $projectId;
    private $client;
    private $httpClient;

    public function __construct()
    {
        $this->projectId = "gramasandhai-90bcc";

        $this->client = new Client();
        $this->client->setAuthConfig(APPPATH . 'Config/fcm_service_account.json');
        $this->client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $this->httpClient = new GuzzleClient();
    }

    public function sendToDevice($deviceTokens, $title, $body, $data = [])
    {
        $accessToken = $this->client->fetchAccessTokenWithAssertion()['access_token'];
        $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

        // Convert single token to array
        if (!is_array($deviceTokens)) {
            $deviceTokens = [$deviceTokens];
        }

        $responses = [];

        foreach ($deviceTokens as $token) {
            $message = [
                "message" => [
                    "token" => $token,
                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                    ],
                    "data" => $data
                ]
            ];

            try {
                $response = $this->httpClient->post($url, [
                    'headers' => [
                        'Authorization' => "Bearer {$accessToken}",
                        'Content-Type'  => 'application/json'
                    ],
                    'json' => $message
                ]);

                $responses[] = json_decode($response->getBody(), true);
            } catch (\Exception $e) {
                $responses[] = ['error' => $e->getMessage()];
            }
        }

        return [
            'status' => 'success',
            'count' => count($deviceTokens),
            'responses' => $responses
        ];
    }


public function sendNotiDevice($deviceTokens, $title, $body, $data = [])
{
    $accessToken = $this->client->fetchAccessTokenWithAssertion()['access_token'];
    $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

    // Convert single token to array
    if (!is_array($deviceTokens)) {
        $deviceTokens = [$deviceTokens];
    }

    $responses = [];

    foreach ($deviceTokens as $token) {

        $message = [
            "message" => [
                "token" => $token,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                ],
                "data" => $data
            ]
        ];

        // ✅ Inject image ONLY if exists
        if (!empty($data['image_url'])) {
            $message["message"]["notification"]["image"] = $data['image_url']; // ✅ Correct placement
        }

        // ✅ Optionally add click_action so URL opens correctly
        if (!empty($data['url'])) {
            $message["message"]["data"]["click_action"] = $data['url'];
        }

        try {
            $response = $this->httpClient->post($url, [
                'headers' => [
                    'Authorization' => "Bearer {$accessToken}",
                    'Content-Type'  => 'application/json'
                ],
                'json' => $message
            ]);

            $responses[] = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $responses[] = ['error' => $e->getMessage()];
        }
    }

    return [
        'status' => 'success',
        'count' => count($deviceTokens),
        'responses' => $responses
    ];
}


}
