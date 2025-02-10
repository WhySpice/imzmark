<?php

class TrueAPI
{
    public static function getToken() {
        $get_response = Utils::curl(URL_KM . "/api/v3/auth/cert/key");
        $get_json = json_decode($get_response, true);
        $uuid = $get_json['uuid'];
        $data = $get_json['data'];

        $signed_data = CADES::Sign($data);

        $post_data = ['uuid' => $uuid, 'data' => $signed_data];
        $post_response = Utils::curl(URL_KM . "/api/v3/true-api/auth/simpleSignIn", 'POST', $post_data);
        $post_json = json_decode($post_response, true);
        $token = $post_json['token'];

        return $token ?: $post_json;
    }

    public static function getBalance($token)
    {
        $headers = ["Authorization: Bearer " . $token];
        $response = Utils::curl(URL_KM . "/api/v3/true-api/elk/product-groups/balance/all", 'GET', [], $headers);
        $get_balance = json_decode($response, true);
        $balance_json = $get_balance;

        try {
            $balance = $balance_json[0]["balance"];
        }
        catch (Exception $e) {
            $balance = $balance_json[1]["balance"];
        }

        return number_format($balance / 100, 2, ',', ' ') . " руб.";
    }
}