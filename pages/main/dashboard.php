<?php
if(!User::CheckAuth())
{
    die(Utils::RedirectJS('/auth'));
}
User::needAuth();
?>

<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md flex items-center">
            <i class="fa-solid fa-barcode fa-2x mr-4"></i>
            <div>
                <h3 class="text-lg">Заказано кодов</h3>
                <p class="text-2xl">0</p>
            </div>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md flex items-center">
            <i class="fa-solid fa-check fa-2x mr-4"></i>
            <div>
                <h3 class="text-lg">Кодов использовано</h3>
                <p class="text-2xl">0</p>
            </div>
        </div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md flex items-center">
            <i class="fa-solid fa-arrow-right fa-2x mr-4"></i>
            <div>
                <h3 class="text-lg">Введено в оборот</h3>
                <p class="text-2xl">0</p>
            </div>
        </div>
        <div class="bg-purple-500 text-white p-4 rounded-lg shadow-md flex items-center">
            <i class="fa-solid fa-tasks fa-2x mr-4"></i>
            <div>
                <h3 class="text-lg">Очередь задач</h3>
                <p class="text-2xl">0</p>
            </div>
        </div>
        <div class="bg-red-500 text-white p-4 rounded-lg shadow-md flex items-center">
            <i class="fa-solid fa-exclamation-triangle fa-2x mr-4"></i>
            <div>
                <h3 class="text-lg">Ошибок</h3>
                <p class="text-2xl">0</p>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold border-b mb-2">
            <i class="fa-solid fa-tasks fa-fw"></i>
            Последние действия
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <a href="#" class="text-md font-semibold text-blue-600 hover:underline">
                    Ввод в оборот
                </a>
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b-2 p-2 text-left">GTIN</th>
                        <th class="border-b-2 p-2 text-left">Линия</th>
                        <th class="border-b-2 p-2 text-left">Партия</th>
                        <th class="border-b-2 p-2 text-left">Дата ввода</th>
                        <th class="border-b-2 p-2 text-left">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="border-b p-2">
                            <span class="active p-1 rounded-full">
                                04602343000815
                            </span>
                        </td>
                        <td class="border-b p-2">1</td>
                        <td class="border-b p-2">1</td>
                        <td class="border-b p-2">2024-08-20</td>
                        <td class="border-b p-2 text-center">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-check"></i>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <a href="#" class="text-md font-semibold text-blue-600 hover:underline">
                    Заказ кодов
                </a>
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="border-b-2 p-2 text-left">GTIN</th>
                        <th class="border-b-2 p-2 text-left">Линия</th>
                        <th class="border-b-2 p-2 text-left">Партия</th>
                        <th class="border-b-2 p-2 text-left">Дата заказа</th>
                        <th class="border-b-2 p-2 text-left">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="border-b p-2">
                            <span class="active p-1 rounded-full">
                                04602343000817
                            </span>
                        </td>
                        <td class="border-b p-2">1</td>
                        <td class="border-b p-2">1</td>
                        <td class="border-b p-2">2024-08-18</td>
                        <td class="border-b p-2 text-center">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">
                                <i class="fad fa-spinner-third fa-spin"></i>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold border-b mb-2">
            <i class="far fa-rss-square fa-fw"></i>
            Обновления
        </h2>
        <div>
            <? foreach (R::getAll('select * from updates') as $key) : ?>
            <div class="p-4 shadow-md mb-2">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-700"><?= $key['header'] ?></h2>
                    <p class="text-sm text-gray-300 mt-2 text-right">
                        <?= Utils::formatDate($key['date']) ?>
                        <? $update_author = R::findOne('users', 'id = ?', [$key['author']]); ?>
                        |
                        <i><?= $update_author['firstname'] ?> <?= $update_author['surname'] ?></i>
                    </p>
                </div>
                <p class="text-sm text-gray-600 mt-2">
                    <?= $key['content'] ?>
                </p>
            </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
