<?php
try
{
    $client = new Socket(SOCKET_IP, SOCKET_PORT);
    $query = $client->sendCommand($_POST['cmd']);
    echo $query;
}
catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

