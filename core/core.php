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
require 'modules/tracy/autoload.php';
error_reporting(0);

require_once "config.php";
require_once "modules/mysql.php";

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));
R::setup( "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB, MYSQL_USER, MYSQL_PASS );

if (!R::testConnection())
    exit("Error: Unable to connect to the database. Contact the developer.");

foreach(glob("core/class/class.*.php") as $filename){
    try{
        require_once $filename;
    }
    catch (ParseError $e){
        exit("Error: Unable to load class {$filename}. Contact the developer. <br>Reason: {$e->getMessage()}.");
    }
}
session_start();
?>
