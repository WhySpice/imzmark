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
class Country
{
    public static function Get(){
        $countryPath = './static/img/country/';
        $country = [];

        $files = scandir($countryPath);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $countryName = pathinfo($file, PATHINFO_FILENAME);
                $flagPath = mb_substr($countryPath, 1) . $file;
                $country[$countryName] = $flagPath;
            }
        }
        return $country;
    }
}