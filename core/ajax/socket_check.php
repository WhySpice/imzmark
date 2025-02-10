<?php
try
{
    $client = new Socket(SOCKET_IP, SOCKET_PORT);
    $ping = $client->ping();

    echo json_encode(["success" => true, "message" => $ping]);
}
catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

