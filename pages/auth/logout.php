<?php
if(User::CheckAuth())
{
    Logger::AddFromPanel('logout');
    session_unset();
}
Utils::RedirectJS('./auth');
?>
