<?php
$getFromDB = R::findOne('tokens', 'name = ?', ['date'])->value;
$tokenDate = new DateTime($getFromDB);
$now = new DateTime();

$diffTimes = $now->getTimestamp() - $tokenDate->getTimestamp();
$diffDays = $now->diff($tokenDate)->days;

$timeLeft = 35500 - $diffTimes + ($diffDays * 86400);

if ($timeLeft < 0) {
    $timeLeft = 0;
}

$time = gmdate("H:i:s", $timeLeft);

die(json_encode(["success" => true, "time" => $time]));
