<?php
$token = R::findOne('tokens', 'name = ?', ['token_km']);
die(json_encode(["success" => true, "balance" => TrueAPI::getBalance($token->value)]));