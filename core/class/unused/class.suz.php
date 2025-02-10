<?php

class SUZ
{
    public static function getToken() {
        $get_response = Utils::curl(URL_KM . "/api/v3/auth/cert/key");
        $get_json = json_decode($get_response, true);
        $uuid = $get_json['uuid'];
        $data = $get_json['data'];

        $signed_data = CADES::Sign($data);

        $post_data = ['uuid' => $uuid, 'data' => $signed_data];
        $post_response = Utils::curl(URL_KM . "/api/v3/auth/cert/" . SUZ_DEVICE_ID, 'POST', $post_data);
        $post_json = json_decode($post_response, true);
        $token = $post_json['token'];

        return $token ?: $post_json;
    }
}