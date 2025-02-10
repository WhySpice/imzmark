<?php
if($_POST['username'] && $_POST['password'])
{
    $check_creditials = R::findOne('users', 'username = ? and password = ?', [$_POST['username'], Utils::Crypt($_POST['password'])]);
    if(!$check_creditials)
        echo json_encode(["success" => false, "message" => "Неверные логин или пароль."]);
    else
    {
        $_SESSION['username'] = $check_creditials->username;
        $hash = Utils::Crypt(Utils::GenerateString(32));
        $_SESSION['hash'] = $hash;

        $check_creditials->hash = $hash;
        if(!$check_creditials->reg_ip)
            $check_creditials->reg_ip = Utils::getClientIP();

        $check_creditials->last_ip = Utils::getClientIP();
        R::store($check_creditials);
        Logger::AddFromPanel('auth');

        echo json_encode([
            "success" => true,
            "message" => "ok",
            "firstname" => $check_creditials['firstname'],
            "surname" => $check_creditials['surname'],
            "lastname" => $check_creditials['lastname'],
            "group" => $check_creditials['group']
        ]);
    }
}
else
    echo json_encode(["success" => false, "message" => "Вы не заполнили поля."]);
?>
