<?php
if(!$token)
    Utils::RedirectJS("/");

$t = R::findOne("emailactivations", "token = ?", [$token]);

if(!$t)
    Utils::RedirectJS("/");

$t->activated = true;
R::store($t);

$u = User::Me();
$u->email_status = true;
R::store($u);

Utils::RedirectJS("/");