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
class Group
{
    public static function getUserGroup($user_id = null)
    {
        if(!$user_id) $user_id = User::Me()->id;
        $user = R::findOne('users', 'id = ?', [$user_id]);
        if(!$user)
            return false;

        switch($user->group)
        {
            case 'admin': return 'Администратор';
            case 'ceh': return 'Работник цеха';
            case 'mark': return 'Маркировщик';
            case 'vsd': return 'Отдел ВСД';
        }
    }

    public static function getGroupBadge($user_id = null)
    {
        if(!$user_id) $user_id = User::Me()->id;
        $user = R::findOne('users', 'id = ?', [$user_id]);
        if(!$user)
            return false;

        switch($user->group)
        {
            case 'admin': return '
                <p class="inline-block text-xs bg-red-500 text-white p-2 rounded-full text-center mt-1 w-max">
                    <i class="fa-solid fa-crown"></i>
                    ' . Group::getUserGroup($user_id) . '
                </p>
            ';
            case 'ceh': return '
                <p class="inline-block text-xs bg-teal-300 text-white p-2 rounded-full text-center mt-1 w-max">
                    <i class="fas fa-wrench"></i>
                    ' . Group::getUserGroup($user_id) . '
                </p>
            ';
            case 'mark': return '
                <p class="inline-block text-xs bg-blue-300 text-white p-2 rounded-full text-center mt-1 w-max">
                    <i class="fas fa-qrcode"></i>
                    ' . Group::getUserGroup($user_id) . '
                </p>
            ';
            case 'vsd': return '
                <p class="inline-block text-xs bg-purple-300 text-white p-2 rounded-full text-center mt-1 w-max">
                    <i class="fas fa-user-tag"></i>
                    ' . Group::getUserGroup($user_id) . '
                </p>
            ';
        }
    }
}