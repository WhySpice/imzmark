<?php
User::needAuth();

$paginator = new Paginator('updates', 10);
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
            <h2 class="text-xl font-semibold">Список обновлений</h2>
            <button id="openUpdateModal" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fa-solid fa-plus fa-fw"></i>
                Добавить
            </button>
            <? include "pages/modals/add_update.php" ?>
        </div>
        <table class="w-full border-collapse">
            <thead>
            <tr>
                <th class="border-b-2 p-2 text-left">№</th>
                <th class="border-b-2 p-2 text-left">Название</th>
                <th class="border-b-2 p-2 text-left">Дата</th>
                <th class="border-b-2 p-2 text-left">Действия</th>
            </tr>
            </thead>
            <tbody>
            <? foreach(array_reverse($page_items) as $key) : ?>
                <tr>
                    <td class="border-b p-2 font-semibold"><?= $key['id'] ?></td>
                    <td class="border-b p-2"><?= $key['header'] ?></td>
                    <td class="border-b p-2">
                        <span class="active p-2 rounded-full">
                        <?= Utils::formatDate($key['date']) ?></td>
                        </span>
                    </td>
                    <td class="border-b p-2">
                        <button class="bg-red-500 text-white text-sm p-2 rounded hover:bg-red-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            <i class="fa-solid fa-trash-can"></i>
                            Удалить
                        </button>
                    </td>
                </tr>
            <? endforeach; ?>
            </tbody>
        </table>
        <?= $paginator->render_html_pagination($page_number); ?>
    </div>
<?php
