<!--
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
-->
<html>
<head>
    <title><?= $settings['title'] ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $settings['description'] ?>">
    <link rel="icon" type="image/svg" href="/static/img/logo.svg" />
    <link href="/static/fa/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/styles.css?v=<?= time() ?>">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://unpkg.com/swup@4"></script>
    <script src="https://unpkg.com/@swup/scripts-plugin@2"></script>
    <script src="/static/js/main.js?v=<?= time() ?>"></script>
    <script src="/static/js/app.js?v=<?= time() ?>"></script>
    <? if(defined('debug')) : ?>
        <script src="/static/js/debug.js?v=<?= time() ?>"></script>
    <? endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
</head>

<? if(User::CheckAuth()) : ?>
<script>
    $(document).ready(function() {
        checkIdentity();
    });
</script>
<? endif; ?>

<body class="bg-gray-50 text-gray-800">
<div id="progress-bar">
    <div class="progress"></div>
</div>
<div id="notification-container" class="fixed right-0 p-4 flex flex-col items-end space-y-4"></div>
<div id="loader" class="fixed right-0 p-4 flex flex-col items-end space-y-4"><i class="fa-duotone fa-spinner-third fa-spin"></i></div>
<div id="modal" class="fixed z-50 inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 backdrop-blur-sm hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-xl w-full">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4"></h2>
        <p id="modalMessage" class="mb-4"></p>
        <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Закрыть</button>
    </div>
</div>
<div id="serverUnavailable" style="z-index: 2" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-300 text-red-800 text-xs bg-opacity-50 backdrop-blur-sm px-6 py-2 rounded-lg shadow-lg hidden">
    🚫 <b>Сервер недоступен!</b> Заказ кодов и ввод в оборот невозможен.
</div>
<? if(User::Me()->group == 'ceh') include "pages/modals/checkIdentity.php"; ?>
<? if(defined('debug')) : include "pages/modals/debug_menu.php"; ?>
<div style="z-index: 2" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-yellow-300 text-yellow-800 text-xs bg-opacity-50 backdrop-blur-sm px-6 py-2 rounded-lg shadow-lg">
    ⚠️ Ведутся технические работы. Возможны проблемы с системой.
</div>
<? endif; ?>
<div class="flex h-screen">
    <!-- Sidebar -->
    <nav class="w-64 bg-white shadow-lg relative">
        <div class="p-4">
            <div class="w-full flex justify-center">
                <h1 class="logo-text text-2xl font-bold text-center flex items-center text-accent">
                    <img src="/static/img/logo.svg" class="w-8 h-8 mr-2">
                    <?= $settings['title'] ?>
                    <sub class="text-xs text-gray-200 font-bold">
                        v<?= $settings['version'] ?>
                    </sub>
                </h1>
            </div>
        </div>
        <? include "sidebar.php"; ?>
        <div class="text-xs text-gray-400 absolute bottom-0 w-full p-4 text-center group">
            <div class="w-full flex justify-center mt-1">
                <i class="fad fa-clock fa-fw mr-1"></i>
                <span id="now" class="text-xs text-gray-400">1 января, 00:00:00</span>
            </div>
            <i class="fad fa-calendar-edit fa-fw"></i>
            Последнее обновление: <span id="updateDate">неизвестно</span>

            <div class="hidden group-hover:block absolute left-1/2 transform -translate-x-1/2 bottom-full w-max bg-white shadow-lg rounded-lg p-2 text-gray-700 text-center">
                Разработано
                <a href="https://whyspice.su" class="text-blue-500 hover:underline">WhySpice</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto p-8">
        <? if(User::CheckAuth()) : ?>
        <header class="bg-white shadow-sm rounded-lg p-4 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm">
                        <i class="fas fa-wallet fa-fw"></i>
                        Текущий баланс:
                        <span id="balance" class="font-semibold text-green-600">загрузка...</span>
                    </p>
                    <!--<p class="text-sm">
                        <i class="fas fa-business-time fa-fw"></i>
                        До конца токена:
                        <span id="timer" class="font-semibold text-blue-600">загрузка...</span>
                    </p>-->
                    <p class="text-sm">
                        <i class="fas fa-server fa-fw"></i>
                        Сервер:
                        <span id="socketServer" class="font-semibold text-green-600">загрузка...</span>
                    </p>
                    <p class="text-sm">
                        <i class="fas fa-business-time fa-fw"></i>
                        Состояние сервисов:
                        <a href="https://status.whyspice.su/status/truemark" id="apiStatus" class="font-semibold text-blue-600">перейти</a>
                    </p>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <a href="/account" class="text-sm text-gray-700 hover:text-blue-600 focus:outline-none">
                            Настройки
                        </a>
                        <? if(User::Me()->group == 'ceh') : ?>
                            <a href="#" onclick="renewIdentity()" class="text-sm text-gray-700 hover:text-blue-600 focus:outline-none">
                                Идентификация
                            </a>
                        <? endif; ?>
                        <a href="/logout" class="text-sm text-gray-700 hover:text-red-600 focus:outline-none">
                            Выход
                        </a>
                    </div>

                    <div class="border-l border-gray-300 h-12 mx-3"></div>

                    <div class="flex items-center">
                        <div class="relative text-right">
                            <p id="username" class="text-sm font-medium whitespace-nowrap">Неопознанный объект</p>
                            <?= Group::getGroupBadge() ?>
                        </div>
                        <div class="relative">
                            <img src="<?= User::getAvatar() ?>" class="w-10 h-10 rounded-full ring-2 ring-blue-300 p-1 ml-3">
                            <span class="bottom-0 left-10 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white rounded-full"></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <? endif; ?>


