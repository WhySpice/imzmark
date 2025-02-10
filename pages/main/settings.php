<?php
User::needAuth();
?>

<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Настройки</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <p class="text-sm font-semibold text-gray-600">Название:</p>
            <div class="flex items-center space-x-2">
                <span id="title-text" class="text-sm text-gray-800"><?= $settings['title'] ?></span>
                <input type="text" id="title-input" class="hidden text-sm p-1 border rounded-md" style="margin-left: 0" value="<?= $settings['title'] ?>">
                <button id="edit-title" class="text-blue-600 hover:text-blue-800">
                    <i class="fa fa-pencil-alt"></i>
                </button>
                <button id="save-title" class="hidden text-green-600 hover:text-green-800">
                    <i class="fa fa-check"></i>
                </button>
                <button id="cancel-title" class="hidden text-red-600 hover:text-red-800">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600">Версия:</p>
            <div class="flex items-center space-x-2">
                <span id="version-text" class="text-sm text-gray-800">v<?= $settings['version'] ?></span>
                <input type="text" id="version-input" class="hidden text-sm p-1 ml-0 border rounded-md" style="margin-left: 0" value="<?= $settings['version'] ?>">
                <button id="edit-version" class="text-blue-600 hover:text-blue-800">
                    <i class="fa fa-pencil-alt"></i>
                </button>
                <button id="save-version" class="hidden text-green-600 hover:text-green-800">
                    <i class="fa fa-check"></i>
                </button>
                <button id="cancel-version" class="hidden text-red-600 hover:text-red-800">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600">Серийный номер сертификата:</p>
            <div class="flex items-center space-x-2">
                <span id="serial-text" class="text-sm text-gray-800"><?= $settings['certSerial'] ?></span>
                <input type="text" id="serial-input" class="hidden text-sm p-1 ml-0 border rounded-md" style="margin-left: 0" value="<?= $settings['certSerial'] ?>">
                <button id="edit-serial" class="text-blue-600 hover:text-blue-800">
                    <i class="fa fa-pencil-alt"></i>
                </button>
                <button id="save-serial" class="hidden text-green-600 hover:text-green-800">
                    <i class="fa fa-check"></i>
                </button>
                <button id="cancel-serial" class="hidden text-red-600 hover:text-red-800">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>

        <div class="flex flex-col">
            <label for="debugMode" class="text-sm font-semibold text-gray-600">Debug Mode</label>
            <input type="checkbox" id="debugMode" class="hidden" <? if($settings['debug']) : ?> checked <? endif; ?>>
            <label for="debugMode" class="relative inline-block w-10 h-5 cursor-pointer">
                <span id="switch-bg" class="absolute inset-0 transition bg-red-500 rounded-full"></span>
                <span class="absolute w-5 h-5 transition bg-white border border-gray-300 rounded-full transform translate-x-0"></span>
            </label>
        </div>
    </div>

    <div class="border-t pt-4 mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
        <button class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-300">
            <i class="fas fa-envelope-open-text fa-fw"></i>
            Уведомления
        </button>
        <button onclick="Redirect('/settings/updates')" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-300">
            <i class="far fa-rss-square fa-fw"></i>
            Обновления
        </button>
        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
            <i class="fas fa-clipboard-user fa-fw"></i>
            Логи пользователей
        </button>
        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
            <i class="fas fa-clipboard-list fa-fw"></i>
            Логи системы
        </button>
        <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">
            <i class="fas fa-exclamation-triangle fa-fw"></i>
            Обновить токены
        </button>
        <button class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">
            <i class="fad fa-trash-restore fa-fw"></i>
            Очистить логи
        </button>
    </div>

    <p class="ml-2 text-md font-semibold text-gray-600">IMZMARK</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 p-4 bg-gray-100 rounded-lg">
        <div>
            <p class="text-sm font-semibold text-gray-600">PHP:</p>
            <p class="text-sm text-gray-800"><?= phpversion() ?></p>
        </div>
    </div>

    <p class="ml-2 text-md font-semibold text-gray-600">Сервер IMZMARK</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 p-4 bg-gray-100 rounded-lg">
        <div>
            <p class="text-sm font-semibold text-gray-600">IP адрес:</p>
            <p class="text-sm text-gray-800"><?= SOCKET_IP ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Порт:</p>
            <p class="text-sm text-gray-800"><?= SOCKET_PORT ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Статус:</p>
            <p class="text-sm text-gray-800">
                <span id="optSocketStatus">
                    неизвестно
                </span>
                <a id="reloadSocketStatus" class="text-gray-400" href="#"><i class="fas fa-sync-alt fa-fw"></i></a>
            </p>
        </div>
    </div>

    <p class="ml-2 text-md font-semibold text-gray-600">TrueAPI</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 p-4 bg-gray-100 rounded-lg">
        <div>
            <p class="text-sm font-semibold text-gray-600">URL Кабинета маркировки:</p>
            <p class="text-sm text-gray-800"><?= URL_KM ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">URL СУЗ:</p>
            <p class="text-sm text-gray-800"><?= URL_SUZ ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Устройство СУЗ:</p>
            <p class="text-sm text-gray-800"><?= SUZ_DEVICE ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">ID устройства СУЗ:</p>
            <p class="text-sm text-gray-800"><?= SUZ_DEVICE_ID ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">OMS ID:</p>
            <p class="text-sm text-gray-800"><?= OMS_ID ?></p>
        </div>
    </div>

    <p class="ml-2 text-md font-semibold text-gray-600">Сервер MySQL</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 p-4 bg-gray-100 rounded-lg">
        <div>
            <p class="text-sm font-semibold text-gray-600">Сервер MySQL:</p>
            <p class="text-sm text-gray-800"><?= MYSQL_HOST ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">База данных MySQL:</p>
            <p class="text-sm text-gray-800"><?= MYSQL_DB ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Пользователь MySQL:</p>
            <p class="text-sm text-gray-800"><?= MYSQL_USER ?></p>
        </div>
    </div>

    <p class="ml-2 text-md font-semibold text-gray-600">Сервер SMTP</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 bg-gray-100 rounded-lg">
        <div>
            <p class="text-sm font-semibold text-gray-600">Имя отправителя:</p>
            <p class="text-sm text-gray-800"><?= SENDER_MAIL ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Сервер SMTP:</p>
            <p class="text-sm text-gray-800"><?= SMTP_HOST ?>:<?= SMTP_PORT ?></p>
        </div>
        <div>
            <p class="text-sm font-semibold text-gray-600">Пользователь SMTP:</p>
            <p class="text-sm text-gray-800"><?= SMTP_USER ?></p>
        </div>
    </div>
    <script>
        function reloadOptSocketStatus()
        {
            SocketCheck(false).then(result => {
                if (result) {
                    $('#optSocketStatus').text(`доступен (${result}ms)`).removeClass('text-red-600').addClass('text-green-600');
                } else {
                    $('#optSocketStatus').text('недоступен').removeClass('text-green-600').addClass('text-red-600');
                }
            });
        }

        $(document).ready(function() {
            reloadOptSocketStatus();
            $('#reloadSocketStatus').on('click', function() {
                reloadOptSocketStatus();
                showNotification('Состояние сервера обновлено.')
            });

            function startEdit(section) {
                $(`#${section}-text`).hide();
                $(`#${section}-input`).removeClass('hidden').focus();
                $(`#edit-${section}`).hide();
                $(`#save-${section}, #cancel-${section}`).removeClass('hidden');
            }

            function cancelEdit(section) {
                $(`#${section}-text`).show();
                $(`#${section}-input`).addClass('hidden');
                $(`#edit-${section}`).show();
                $(`#save-${section}, #cancel-${section}`).addClass('hidden');
            }

            function saveEdit(section) {
                const newValue = $(`#${section}-input`).val();
                SendAjax('/api/edit_settings', {
                    section: section,
                    value: newValue
                }, function(response) {
                    if (response.status === 'success') {
                        $(`#${section}-text`).text(newValue).show();
                        $(`#${section}-input`).addClass('hidden');
                        $(`#edit-${section}`).show();
                        $(`#save-${section}, #cancel-${section}`).addClass('hidden');
                        console.log(`Значение успешно обновлено.`);
                    }
                    else {
                        console.error(`Ошибка при обновлении: `, response.message);
                    }
                });
            }

            $('#edit-title').click(() => startEdit('title'));
            $('#cancel-title').click(() => cancelEdit('title'));
            $('#save-title').click(() => saveEdit('title'));

            $('#edit-version').click(() => startEdit('version'));
            $('#cancel-version').click(() => cancelEdit('version'));
            $('#save-version').click(() => saveEdit('version'));

            $('#edit-serial').click(() => startEdit('serial'));
            $('#cancel-serial').click(() => cancelEdit('serial'));
            $('#save-serial').click(() => saveEdit('serial'));

            var checkbox = $('#debugMode');
            var slider = checkbox.next('label').children('span').last();
            var switchBg = $('#switch-bg');
            function updateSwitch() {
                if (checkbox.is(':checked')) {
                    slider.css('transform', 'translateX(100%)');
                    switchBg.css('background-color', '#34D399');
                } else {
                    slider.css('transform', 'translateX(0)');
                    switchBg.css('background-color', '#EF4444');
                }
            }
            updateSwitch();
            checkbox.change(function(){
                VisibilityLoader(true);
                updateSwitch();

                var status = checkbox.is(':checked') ? 1 : 0;
                SendAjax('/api/debug_mode', {
                    status: status
                }, function(response) {
                    if (response.success) {
                        showNotification(response.message, '');
                        VisibilityLoader(false);
                        window.location = "/settings";
                    }
                    else {
                        showNotification(response.message, 'error');
                        VisibilityLoader(false);
                    }
                });
            });
        });
    </script>
</div>