<?php
if(!User::CheckAuth())
    die(json_encode(["success" => false, "message" => "У вас недостаточно прав."]));

if(!User::isAdmin())
    die(json_encode(["success" => false, "message" => "У вас недостаточно прав."]));

if(!$_POST['header'] || !$_POST['content'] )
    die(json_encode(["success" => false, "message" => "Вы не заполнили поля."]));

$update = R::dispense('updates');
$update->header = $_POST['header'];
$update->content = $_POST['content'];
$update->date = time();
$update->author = User::Me()->id;
R::store($update);
die(json_encode(["success" => true, "message" => "Обновление добавлено."]));