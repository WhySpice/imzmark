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
class User
{
    public static function CheckAuth()
    {
        if(isset($_SESSION['hash']) && isset($_SESSION['username']))
        {
            $auth = R::findOne('users', 'username = ? and hash = ?', [$_SESSION['username'], $_SESSION['hash']]);
            if ($auth)
                return true;
            else {
                session_unset();
                return false;
            }
        }
        else
            return false;
    }

    public static function Me()
    {
        if(User::CheckAuth())
            $me = R::findOne('users', 'username = ? and hash = ?', [$_SESSION['username'], $_SESSION['hash']]);

        return $me;
    }

    public static function needAuth()
    {
        if(!User::CheckAuth()){
            //Utils::RedirectJS('/auth');
            http_response_code(403);
            die(include "pages/bootstrap/403.php");
        }
        User::setActivity();
        /*if(!User::getEmailStatus(null, false) && User::Me()->group != 'ceh')
            echo '
                <a class="flex items-center justify-between p-4 text-sm font-semibold text-white bg-blue-600 shadow-md rounded-md mb-2" 
                href="/account">
                  <div class="flex items-center">
                    <i class="fa-light fa-triangle-exclamation mr-2"></i>
                    <span>Вам необходимо подтвердить ваш E-mail.</span>
                  </div>
                  <span>Подтверждение →</span>
                </a>
                <script>
                    setTimeout(function(){logDebug("user: need confirm email", "warn")}, 1000);
                </script>
            ';*/
    }

    public static function needntAuth()
    {
        if(User::CheckAuth()){
            Utils::RedirectJS('./');
        }
    }

    public static function isAdmin($error = false)
    {
        if(!User::Me()->group == 'admin')
            if(!$error)
                return false;
            else
                die(include_once "pages/bootstrap/403.php");
        else
            return true;
    }

    public static function getLastVisit()
    {
        if(User::CheckAuth())
        {
            $fLastVisit = R::getAll('select * from logs where user = ? and type = ? order by id desc limit 2', [User::Me()->username, 'auth']);
            $gLastVisit = date("d.m.Y H:i:s", $fLastVisit[1]['date']) ?: "today";

            return $gLastVisit;
        }
    }

    public static function setActivity()
    {
        $db = User::Me();
        $db->last_activity = time();
        R::store($db);
        return true;
    }

    public static function getActivity($lastActionTimestamp)
    {
        $now = time();
        $timeDifference = $now - $lastActionTimestamp;

        if ($timeDifference <= 300) {
            return "<span class='text-green-500'>Онлайн</span>";
        } elseif ($timeDifference <= 3600) {
            $minutesAgo = floor($timeDifference / 60);
            return "был онлайн $minutesAgo минут" . ($minutesAgo > 1 ? "" : "у") . " назад";
        } elseif ($timeDifference <= 86400) {
            $hoursAgo = floor($timeDifference / 3600);
            return "был онлайн $hoursAgo часов" . ($hoursAgo > 1 ? "s" : "") . " назад";
        } elseif ($timeDifference <= 604800) {
            $daysAgo = floor($timeDifference / 86400);
            return "был онлайн $daysAgo дней" . ($daysAgo > 1 ? "s" : "") . " назад";
        } elseif ($timeDifference <= 5184000) {
            return "был онлайн месяц назад";
        } else {
            return "был онлайн давно (" . date("d M Y H:i:s", $lastActionTimestamp) . ")";
        }
    }

    public static function getAvatar($id = null)
    {
        if(!$id)
            return User::Me()['avatar'] ?: "/api/getSymAvatar/" . User::Me()['firstname'] . " " . User::Me()['surname'];
        else {
            $usr = R::findOne('users', 'id = ?', [$id]);
            return $usr['avatar'] ?: "/api/getSymAvatar/" . $usr['firstname'] . " " . $usr['surname'];
        }
    }

    public static function getEmailStatus($id = null, $need_text = true)
    {
        if(!$id)
        {
            if($need_text)
                return User::Me()['email_status'] ? "Подтвержден" : "Не подтвержден";
            else
                return User::Me()['email_status'] ? true : false;
        }
        else
        {
            if($need_text)
                return R::findOne('users', 'id = ?', [$id])['email_status'] ? "Подтвержден" : "Не подтвержден";
            else
                return R::findOne('users', 'id = ?', [$id])['email_status'] ? true : false;
        }
    }

    public static function deactivateEmailActivationURL()
    {
        $emailActivations = R::find('emailactivations', 'user = ? AND activated = ?', [User::Me()['username'], 0]);
        foreach ($emailActivations as $activation) {
            $activation->activated = 1;
            R::store($activation);
        }
    }

    public static function generateEmailActivationURL()
    {
        if(User::CheckAuth())
        {
            User::deactivateEmailActivationURL();

            $db = R::dispense('emailactivations');
            $db->user = User::Me()['username'];
            $db->token = Utils::GenerateString(10);
            $db->activated = false;
            R::store($db);

            return $db->token;
        }
    }
}
?>
