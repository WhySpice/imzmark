<?php
User::needAuth();
?>

<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <h2 class="text-xl font-semibold mb-6">Настройки аккаунта</h2>
    <form>
        <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div class="ms-3 text-sm font-medium">
                В данный момент, страница настроек аккаунта недоступна...
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Аватар:</label>
            <div class="flex items-center mb-2">
                <img src="<?= User::getAvatar() ?>" id="avatar" class="w-16 h-16 rounded-full mr-4">
                <input type="file" id="avatar-upload" class="hidden">
                <button type="button" class="bg-blue-500 text-white p-2 rounded disabled:bg-gray-300" onclick="$('#avatar-upload').click()" disabled>Обновить</button>
            </div>
            <div id="upload-progress" class="hidden w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-500 h-2.5 rounded-full" style="width: 0%"></div>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Почта:</label>
            <input type="email" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?= User::Me()->email ?>">
        </div>
        <div class="mt-6 mb-6">
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded disabled:bg-gray-300" disabled>Сохранить изменения</button>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Текущий пароль:</label>
            <input type="password" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700">Новый пароль:</label>
                <input type="password" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>

            <div>
                <label class="block text-gray-700">Подтвердите новый пароль:</label>
                <input type="password" class="w-full p-2 border border-gray-300 rounded mt-1">
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded disabled:bg-gray-300" disabled>Изменить пароль</button>
        </div>
    </form>
    <script>
        $('#avatar-upload').on('change', function() {
            var progressBar = $('#upload-progress');
            progressBar.removeClass('hidden');
            var progress = progressBar.find('div');
            var width = 0;
            var interval = setInterval(function() {
                if (width >= 100) {
                    clearInterval(interval);
                    progressBar.addClass('hidden');
                } else {
                    width += 10;
                    progress.css('width', width + '%');
                }
            }, 100);
        });
    </script>
</div>
