<?php
User::needAuth();
?>

<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <div id="server_unavailable" class="bg-red-500 text-white rounded-lg shadow-sm p-6 mb-6 hidden">
        <i class="fas fa-exclamation-square"></i>
        Нет связи с сервером. Ввод в оборот недоступен!
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Ввести продукцию в оборот</h2>
        <a href="#" class="bg-gray-200 text-gray-800 p-2 rounded-md hover:bg-gray-300 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
            <i class="fa-solid fa-list-check fa-fw"></i>
            Просмотр задач
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <label for="line" class="block text-sm font-medium text-gray-700 mb-1">Выбор линии:</label>
            <select id="line" class="w-full p-2 bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <? $lines = R::getAll('select * from `lines`'); ?>
                <? foreach ($lines as $key) : ?>
                    <option>Линия #<?= $key['line'] ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div>
            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Выбор файла:</label>
            <select id="file" class="w-full p-2 bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <!--<option>10/7 Масло шок 180г фольга</option>-->
            </select>
        </div>
    </div>

    <div class="hidden">
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <p class="text-sm text-gray-600 mb-2">Продукция: <span id="product" class="font-semibold">Масло шоколадное 180г фольга</span></p>
            <p class="text-sm text-gray-600 mb-2">Номер партии: <span id="batchNumber" class="font-semibold">10/7</span></p>
            <p class="text-sm text-gray-600 mb-2">GTIN: <span id="gtin" class="font-semibold">0460243300247</span></p>
            <p class="text-sm text-gray-600 mb-2">Количество кодов: <span id="codeCount" class="font-semibold">8328</span></p>
            <p class="text-sm text-gray-600 mb-2">Файл: <span id="file" class="font-semibold">Line5\OUT_AGGREGATION_LVL0_10055923-0000-0005-0004-602433002475.xml</span></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="productionDate" class="block text-sm font-medium text-gray-700 mb-1">Дата производства:</label>
                <input type="date" id="productionDate" value="2024-08-27" class="w-full p-2 bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="expiryDate" class="block text-sm font-medium text-gray-700 mb-1">Дата окончания срока годности:</label>
                <input type="date" id="expiryDate" value="2024-10-05" class="w-full p-2 bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="mb-6">
            <label for="vsd" class="block text-sm font-medium text-gray-700 mb-1">Номер ВСД:</label>
            <input type="text" id="vsd" class="w-full p-2 bg-gray-50 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!--<div class="flex flex-wrap gap-4 mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-600">
                <span class="ml-2 text-sm text-gray-700">Данные верны</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-600">
                <span class="ml-2 text-sm text-gray-700">Отправить автоматически</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-600">
                <span class="ml-2 text-sm text-gray-700">Это дофасовка</span>
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-600">
                <span class="ml-2 text-sm text-gray-700">Это масло охлажденное (не заморозка!)</span>
            </label>
        </div>-->

        <div class="border-t pt-6 pb-6">
           <!-- <h3 class="text-lg font-semibold mb-4">Автоматическая отправка:</h3>-->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <button id="sendAutoReport" class="bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300">
                    Отправить
                </button>
            </div>
        </div>
    </div>
    <!--
    <div class="border-t pt-6">
        <h3 class="text-lg font-semibold mb-4">Ручная отправка:</h3>
        <p class="text-sm text-gray-600 mb-4">Для проблемных файлов или для продукции, которая уже на полках</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button id="sendReport" class="bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Отправить отчет о нанесении
            </button>
            <button id="sendCirculation" class="bg-green-500 text-white p-3 rounded-md hover:bg-green-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                Отправить ввод в оборот
            </button>
        </div>
    </div>
    -->
    <script>
        /*$(document).ready(function() {
            setTimeout(function(){
                if (cryptopro_status == false) {
                    $('#cryptopro_unavailable').removeClass('hidden');
                    $('#line').prop("disabled", true);
                    $('#file').prop("disabled", true);
                    $('#productionDate').prop("disabled", true);
                    $('#expiryDate').prop("disabled", true);
                    $('#vsd').prop("disabled", true);
                    $('#sendAutoReport').prop("disabled", true);
                    $('#sendReport').prop("disabled", true);
                    $('#sendCirculation').prop("disabled", true);
                }
            }, 1000);
        });*/
    </script>
</div>