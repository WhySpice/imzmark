<?php
if(!User::CheckAuth())
    die(json_encode(["success" => false, "message" => "You have no rights."]));

if(!User::isAdmin())
    die(json_encode(["success" => false, "message" => "You have no rights."]));

if(!$_POST['id'])
    die(json_encode(["success" => false, "message" => "Invalid query."]));

$db = R::findOne('users', 'id = ?', [$_POST['id']]);

if(!$db)
    die(json_encode(["success" => false, "message" => "User not found."]));

$extra = [
    'user_id' => $db->id,
];
Logger::AddFromPanel('delete_user', $extra);

R::trash($db);
die(json_encode(["success" => true, "message" => "User deleted."]));