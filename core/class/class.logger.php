<?php
/*
# Welcome to WHYSPICE OS 0.0.1 (GNU/Linux 3.13.0.129-generic x86_64)

root@localhost:~ bash ./whyspice-work.sh
> Executing...

         _       ____  ____  _______ ____  ________________
        | |     / / / / /\ \/ / ___// __ \/  _/ ____/ ____/
        | | /| / / /_/ /  \  /\__ \/ /_/ // // /   / __/
        | |/ |/ / __  /   / /___/ / ____// // /___/ /___
        |__/|__/_/ /_/   /_//____/_/   /___/\____/_____/

                            Web Dev.
                WHYSPICE © 2024 # whyspice.su

> Disconnecting.

# Connection closed by remote host.
*/
class Logger
{
    public static function AddFromPanel($type, $extra = null)
    {
        $author = User::Me();
        //$geoIP = Utils::getGeoIP();
        switch($type) {
            case 'auth':
                $action = "Авторизовался.";
                break;
            case 'account':
                $action = "Обновил свой аккаунт.";
                break;
            case 'invite':
                $action = "Пригласил {$extra['email']} с ролью {$extra['role']}.";
                break;
            case 'update_site':
                $action = "Обновил настройки сайта.";
                break;
            case 'delete_user':
                $action = "Удалил пользователя #{$extra['user_id']}.";
                break;
            case 'edit_user':
                $action = "Отредактировал пользователя #{$extra['user_id']}, роль {$extra['role']}.";
                break;
            case 'edit_site_settings':
                $action = "Изменил настройки сайта.";
                break;
            case 'logout':
                $action = "Вышел из аккаунта.";
                break;
        }

        $query = R::dispense('logs');
        $query->type = $type;
        $query->user = $author->username;
        $query->ip = Utils::getClientIP();
        //$query->country = $geoIP['country'];
        $query->message = $action;
        $query->date = time();

        R::store($query);
    }

    public static function Add($message, $key, $client_id)
    {
        $query = R::dispense('logs');
        $query->type = 'loader';
        $query->user = $key;
        $query->client_id = $client_id;
        $query->ip = Utils::getClientIP();
        $query->country = Utils::getGeoIP()['country'];
        $query->message = $message;
        $query->date = time();

        R::store($query);
    }

    public static function getCountry($ip)
    {
        return Utils::replaceSpacesWithDashes(R::findOne('logs', 'ip = ?', [$ip])['country']) ?: "Unknown";
    }

}
?>
