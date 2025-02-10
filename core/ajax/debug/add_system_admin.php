<?php
if(R::findOne('users', 'username = ?', ['admin']))
    die(json_encode(["success" => false, "message" => "not allowed"]));

$user = R::dispense('users');
$user->username = 'admin';
$user->password = 'MjEyMzJmMjk3YTU3YTVhNzQzODk0YTBlNGE4MDFmYzM=';
$user->email = 'admin@admin.ru';
$user->firstname = 'Админ';
$user->surname = 'Админов';
$user->lastname = 'Админов';
$user->group = 'admin';
R::store($user);
echo json_encode(["success" => true, "message" => "ok"]);
?>
