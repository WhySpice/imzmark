<?php
if(!User::CheckAuth())
    die(json_encode(["success" => false, "message" => "У вас недостаточно прав."]));

if(!User::isAdmin())
    die(json_encode(["success" => false, "message" => "У вас недостаточно прав."]));

$status = R::findOne('settings', 'name = ?', ['debug']);
$status->value = $_POST['status'];
R::store($status);

if($_POST['status'] == 1)
    die(json_encode(["success" => true, "message" => "DEBUG MODE включен."]));
else
    die(json_encode(["success" => true, "message" => "DEBUG MODE выключен."]));