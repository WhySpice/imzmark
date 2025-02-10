<?php
User::needAuth();
?>

<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <div id="cryptopro_unavailable" class="bg-red-500 text-white rounded-lg shadow-sm p-6 mb-6 hidden">
        <i class="fas fa-exclamation-square"></i>
        Нет связи с КриптоПро ЭЦП Browser Plug-in. Заказ кодов недоступен!
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Заказ кодов</h2>
        <a href="#" class="bg-gray-200 text-gray-800 p-2 rounded-md hover:bg-gray-300 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
            <i class="fa-solid fa-list-check fa-fw"></i>
            Просмотр задач
        </a>
    </div>
    <form>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div>
                <label class="block text-gray-700">Выбор линии:</label>
                <select id="line" class="w-full p-2 border border-gray-300 rounded mt-1">
                    <option>Линия 1</option>
                    <option>Линия 2</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Выбор продукции:</label>
                <select id="product" class="w-full p-2 border border-gray-300 rounded mt-1">
                    <option>Масло шоколадное 180г фольга</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Номер партии:</label>
            <input id="batch" type="text" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Количество кодов:</label>
            <input id="codesCount" type="text" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div>
                <label class="block text-gray-700">Дата производства:</label>
                <input type="date" id="productionDate" class="w-full p-2 border border-gray-300 rounded mt-1" value="2024-08-27">
            </div>

            <div>
                <label class="block text-gray-700">Дата окончания срока годности:</label>
                <input type="date" id="expiryDate" class="w-full p-2 border border-gray-300 rounded mt-1" value="2025-08-27">
            </div>
        </div>
        <div class="mt-6">
            <button id="order" type="submit" class="w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300">Создать заказ</button>
        </div>
    </form>

    <script>
        /*if(cryptopro_status == false)
        {
            $('#cryptopro_unavailable').removeClass('hidden');
            $('#line').prop("disabled", true);
            $('#product').prop("disabled", true);
            $('#batch').prop("disabled", true);
            $('#codesCount').prop("disabled", true);
            $('#productionDate').prop("disabled", true);
            $('#expiryDate').prop("disabled", true);
            $('#order').prop("disabled", true);
        }*/
    </script>
</div>