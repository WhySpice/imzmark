<?php
if($_POST['username'])
{
    echo json_encode(["success" => false, "message" => "Не удалось отправить E-mail."]);
}
else
    echo json_encode(["success" => false, "message" => "Вы не заполнили поля."]);
?>
