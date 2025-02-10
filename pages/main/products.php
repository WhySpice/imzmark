<?php
User::needAuth();

$paginator = new Paginator('products', 10);
$page_number = $page ?: 1;
if($_POST['search'])
{
    $search = $_POST['search'];
    $paginator->query('username like ?', ["%{$search}%"]);
}
$page_items = $paginator->get_page($page_number);
?>

<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Продукция</h2>
        <button class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fa-solid fa-plus fa-fw"></i>
            Добавить
        </button>
    </div>
    <table class="w-full border-collapse">
        <thead>
        <tr>
            <th class="border-b-2 p-2 text-left">Название</th>
            <th class="border-b-2 p-2 text-left">GTIN</th>
            <th class="border-b-2 p-2 text-left">Линия</th>
            <th class="border-b-2 p-2 text-left">Действия</th>
        </tr>
        </thead>
        <tbody>
        <? foreach($page_items as $key) : ?>
            <tr>
                <td class="border-b p-2 font-semibold"><?= $key['product_name'] ?></td>
                <td class="border-b p-2"><?= $key['GTIN'] ?></td>
                <td class="border-b p-2">
                    <span class="active p-2 rounded-full">
                        Линия #<?= $key['line_id'] ?>
                    </span>
                </td>
                <td class="border-b p-2">
                    <button class="bg-yellow-500 text-white text-sm p-2 rounded hover:bg-yellow-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Изменить
                    </button>
                    <button class="bg-red-500 text-white text-sm p-2 rounded hover:bg-red-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        <i class="fa-solid fa-trash-can"></i>
                        Удалить
                    </button>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>
