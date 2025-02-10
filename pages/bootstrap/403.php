<main class="h-full pb-16 overflow-y-auto transition-fade" id="swup">
    <? if(!User::CheckAuth()) : ?>
    <!--<script>
        showNotification('Авторизационная сессия истекла.\nДля просмотра данной страницы нужно войти в аккаунт.', 'error');
    </script>-->
    <? endif; ?>
    <div class="container flex flex-col items-center px-6 mx-auto">
        <span class="mt-4 text-6xl text-gray-300">
            <i class="fa-solid fa-circle-exclamation"></i>
        </span>
        <h1 class="text-6xl font-semibold text-gray-300 mt-3">
            403
        </h1>
        <p class="text-2xl font-semibold mt-3">
            Доступ запрещен.
        </p>
        <p class="text-lg">
            Вы не можете просматривать данную страницу.
        </p>
    </div>
</main>