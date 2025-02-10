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
class Utils
{
    public static function Now()
    {
        $now = date('Y-m-d H:i:s');
        return $now;
    }

    public static function Alert($text)
    {
        echo '<script>alert("'.$text.'");</script>';
    }

    public static function Redirect($link)
    {
        header('location: ' . $link);
    }

    public static function RedirectJS($link)
    {
        echo "<script>swup.navigate('{$link}');</script>";
    }

    public static function curl($url, $method = 'GET', $data = [], $headers = []) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($method == 'POST' || $method == 'PUT') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $headers[] = 'Content-Type: application/json';
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public static function GenerateString($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }

    public static function removeSpecialChars($text) {
        return preg_replace('/[^A-Za-z0-9]/', '', $text);
    }

    public static function Crypt($string)
    {
        return base64_encode(md5($string));
    }

    public static function xor_pack($text, $key) {
        $result = '';

        for($i=0; $i<strlen($text); )
        {
            for($j=0; ($j<strlen($key) && $i<strlen($text)); $j++,$i++)
            {
                $result .= $text{$i} ^ $key{$j};
            }
        }

        return $result;
    }

    public static function encryptRequest($data)
    {
        $key = 'qfiuezhlwmyyfnvpcegmoqvywrncvxwvywdbrtsrtkzqyvgxgbbxybunepksmdjubpkbsjnujurausahmitghzguhushxrbyfwhzoousyvtsxfqcojmmgovmwogdsodjtaxuvfwgyslxrqfikvpdbsettxtatesoddetdrqqgoieuvabssapivzhnrekgabozzmmbqqlwhuuyxpqaeqbgypbqqbpjcdicvtxtiteqnsplixeqslozankryi';
        $getLen = strlen($data);
        $keyLen = strlen($key);

        if ($getLen <= $keyLen) {
            return $data ^ $key;
        }

        for ($i = 0; $i < $getLen; ++$i) {
            $data[$i] = $data[$i] ^ $key[$i % $keyLen];
        }
        return $data;
    }

    public static function daysToTimestamp($days) {
        return 86400 * $days;
    }

    public static function convertTimestamp($timestamp) {
        $dt1 = new DateTime("@0");
        $dt2 = new DateTime("@$timestamp");
        $diff = $dt1->diff($dt2);

        $str = '';
        if ($diff->y) {
            $str .= $diff->y . ' year' . ($diff->y > 1 ? 's ' : ' ');
        }
        if ($diff->m) {
            $str .= $diff->m . ' month' . ($diff->m > 1 ? 's ' : ' ');
        }
        if ($diff->d) {
            $str .= $diff->d . ' day' . ($diff->d > 1 ? 's ' : ' ');
        }
        if ($diff->h) {
            $str .= $diff->h . ' hour' . ($diff->h > 1 ? 's ' : ' ');
        }
        return $str;
    }

    public static function formatDate($unixtime, $showTime = false) {
        $datetime = new DateTime();
        $datetime->setTimestamp($unixtime);

        $formatter = new \IntlDateFormatter(
            'ru_RU',
            \IntlDateFormatter::LONG,
            $showTime ? \IntlDateFormatter::SHORT : \IntlDateFormatter::NONE
        );

        return $formatter->format($datetime);
    }

    public static function getDomain()
    {
        return $_SERVER['HTTP_HOST'];
    }

    public static function getClientIP()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function replaceSpacesWithDashes($text) {
        $textWithDashes = str_replace(' ', '-', $text);
        return $textWithDashes;
    }

    public static function getGeoIP($ip = null)
    {
        $qIP = $ip ?: Utils::getClientIP();
        $get = json_decode(file_get_contents('http://ip-api.com/json/' . $qIP), true);
        return $get;
    }

    public static function getLastModifiedDateInDirectory($directory) {
        $latestTime = 0;
        $latestFile = '';

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));
        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $fileTime = $file->getMTime();
                if ($fileTime > $latestTime) {
                    $latestTime = $fileTime;
                    $latestFile = $file->getPathname();
                }
            }
        }

        if ($latestTime > 0) {
            return date("d.m.Y H:i:s", $latestTime);
        } else {
            return false;
        }
    }

}
?>
