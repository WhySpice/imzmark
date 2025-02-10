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

require_once "core/core.php";
use Tracy\Debugger;

/*
 *  Define $settings for all included pages
 * */
$settings = R::getAssoc('SELECT name, value FROM settings');

if($settings['debug']) {
    define('debug', true);
    Debugger::enable(Debugger::Development);
    Debugger::$showBar = false;
    Debugger::$strictMode = true;
    Debugger::$dumpTheme = 'dark';
    error_reporting(E_ERROR & E_WARNING);
}

/*
 *  idk
 * */
if (!strpos($_SERVER['REQUEST_URI'], "api/"))
    include "pages/bootstrap/header.php";


$router = new Router("");
$router->setSettings($settings);

#
#     AJAX Endpoints
#
$router->addRoute('POST', '/api/auth', function ($settings) {
    include "core/ajax/auth.php";
});
$router->addRoute('POST', '/api/forgot-password', function ($settings) {
    include "core/ajax/forgot_password.php";
});
$router->addRoute('POST', '/api/get_latest_update', function ($settings) {
    include "core/ajax/get_latest_update.php";
});
$router->addRoute('POST', '/api/get_balance', function ($settings) {
    include "core/ajax/get_balance.php";
});
$router->addRoute('POST', '/api/get_token_time', function ($settings) {
    include "core/ajax/get_token_time.php";
});
$router->addRoute('POST', '/api/add_line', function ($settings) {
    include "core/ajax/add_line.php";
});
$router->addRoute('POST', '/api/add_update', function ($settings) {
    include "core/ajax/add_update.php";
});
$router->addRoute('POST', '/api/debug_mode', function ($settings) {
    include "core/ajax/debug_mode.php";
});


$router->addRoute('GET|POST', '/api/cades_query', function ($settings) {
    include "core/ajax/cades_query.php";
});
$router->addRoute('GET|POST', '/api/socket_check', function ($settings) {
    include "core/ajax/socket_check.php";
});
$router->addRoute('GET|POST', '/api/socket', function ($settings) {
    include "core/ajax/socket.php";
});
$router->addRoute('GET|POST', '/api/get_truemark_status', function ($settings) {
    include "core/ajax/get_truemark_status.php";
});

#
#     Main Pages
#
$router->addRoute('GET', '/', function ($settings) {
    include "pages/main/dashboard.php";
});
$router->addRoute('GET', '/account', function ($settings) {
    include "pages/main/account.php";
});
$router->addRoute('GET', '/input', function ($settings) {
    include "pages/main/input.php";
});
$router->addRoute('GET', '/order', function ($settings) {
    include "pages/main/order.php";
});
$router->addRoute('GET', '/lines', function ($settings) {
    include "pages/main/lines.php";
});
$router->addRoute('GET', '/products', function ($settings) {
    include "pages/main/products.php";
});
$router->addRoute('GET', '/users', function ($settings) {
    include "pages/main/users.php";
});
$router->addRoute('GET', '/users/{page}', function ($settings, $page) {
    include "pages/main/users.php";
});
$router->addRoute('GET', '/settings', function ($settings) {
    include "pages/main/settings.php";
});
$router->addRoute('GET', '/support', function ($settings) {
    include "pages/main/support.php";
});
$router->addRoute('GET', '/settings/updates', function ($settings) {
    include "pages/main/updates.php";
});

#
#     User Pages
#
$router->addRoute('GET', '/auth', function ($settings) {
    include "pages/auth/auth.php";
});
$router->addRoute('GET', '/logout', function ($settings) {
    include "pages/auth/logout.php";
});
$router->addRoute('GET', '/forgot-password', function ($settings) {
    include "pages/auth/forgot_password.php";
});
$router->addRoute('GET', '/request-access', function ($settings) {
    include "pages/auth/request_access.php";
});

#
#     Debug:
#
if(defined('debug')) {
    $router->addRoute('POST', '/api/debug/addadmin', function ($settings) {
        include "core/ajax/debug/add_system_admin.php";
    });
}


#
#     API
#
$router->addRoute('GET', '/api/getSymAvatar/{name}', function ($settings, $name) {
    include "core/api/getSymAvatar.php";
});
$router->addRoute('GET', '/api/cronjob', function ($settings) {
    include "core/api/cronjob.php";
});

# Other stuff aka trash code
$router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
if (!strpos($_SERVER['REQUEST_URI'], "api/"))
    include "pages/bootstrap/footer.php";
?>
