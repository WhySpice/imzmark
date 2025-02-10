<?php
if(!User::CheckAuth())
    die(json_encode(["success" => false, "message" => "У вас недостаточно прав."]));

if(!User::isAdmin())
    die(json_encode(["success" => false, "message" => "У вас недостаточно прав."]));

if(!$_POST['line'])
    die(json_encode(["success" => false, "message" => "Вы не заполнили поля."]));

if(R::findOne('lines', 'line = ?', [$_POST['line']]))
    die(json_encode(["success" => false, "message" => "Данная линия уже существует."]));

$line = R::dispense('lines');
$line->line = $_POST['line'];
$line->comment = $_POST['comment'] ?: 'описание отсутствует';
R::store($line);
die(json_encode(["success" => true, "message" => "Линия добавлена."]));