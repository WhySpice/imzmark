<?php
User::needAuth();

$paginator = new Paginator('users', 10);
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
        <h2 class="text-xl font-semibold">Просмотр пользователей</h2>
        <button id="openUserModal" class="bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <i class="fa-solid fa-plus fa-fw"></i>
            Добавить
        </button>
        <? include "pages/modals/add_user.php" ?>
    </div>
    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
        <tr>
            <th class="border-b-2 p-2 text-left">Имя</th>
            <th class="border-b-2 p-2 text-left">Логин</th>
            <!--<th class="border-b-2 p-2 text-left">Почта</th>-->
            <th class="border-b-2 p-2 text-left">Привилегия</th>
            <th class="border-b-2 p-2 text-left">Последняя активность</th>
            <th class="border-b-2 p-2 text-left">Действия</th>
        </tr>
        </thead>
        <tbody>
        <tr class="hover:bg-gray-50 transition duration-300">
            <? foreach($page_items as $key) : ?>
                <td class="border-b p-2">
                    <div class="flex items-center">
                        <img src="<?= User::getAvatar($key['id']) ?>" class="w-8 h-8 rounded-full mr-2">
                        <span><?= $key['firstname'] ?> <?= $key['surname'] ?> <?= $key['lastname'] ?></span>
                    </div>
                </td>
                <td class="border-b p-2"><?= $key['username'] ?></td>
                <!--<td class="border-b p-2">ivanov@example.com</td>-->
                <td class="border-b p-2"><?= Group::getGroupBadge($key['id']) ?></td>
                <td class="border-b p-2"><?= User::getActivity($key['last_activity']) ?></td>
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
            <? endforeach; ?>
        </tr>
        </tbody>
    </table>
    <?= $paginator->render_html_pagination($page_number); ?>
</div>
