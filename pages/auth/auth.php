<?php
User::needntAuth();
?>

<main class="h-full overflow-y-auto transition-fade" id="swup">
    <a class="flex items-center justify-between p-4 text-sm font-semibold text-white bg-blue-600 shadow-md"
       href="/request-access">
        <div class="flex items-center">
            <i class="fa-light fa-triangle-exclamation mr-2"></i>
            <span>Для доступа к платформе, необходимо иметь учетную запись. Если у вас нет учетной записи, необходимо ее получить.</span>
        </div>
        <span class="text-blue-300">Отправить запрос →</span>
    </a>
    <div class="flex items-center p-6 main">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img class="object-cover w-full h-full block" src="/static/img/auth_splash.jpg">
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <form method="post">
                            <h1 class="mb-4 text-xl font-semibold text-gray-600">
                                Авторизация
                            </h1>
                            <label class="block text-sm">
                                <span class="text-gray-700">Логин</span>
                                <input id="username" type="text" class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-md" required autocomplete="false">
                            </label>
                            <label class="block text-sm mt-2 mb-2">
                                <span class="text-gray-700">Пароль</span>
                                <input id="password" type="password" class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-md" required>
                            </label>

                            <button type="button" class="block w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300">
                                Вход
                            </button>

                            <a class="block border border-blue-300 text-blue-300 p-1 rounded-md hover:bg-blue-300 hover:text-white transition duration-300 text-center mt-2" href="/forgot-password">
                                Забыли пароль?
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('button[type="button"]').click(function () {
            VisibilityLoader(true);
            var username = $('#username').val();
            var password = $('#password').val();

            var formData = {
                username: username,
                password: password
            };

            SendAjax('./api/auth', formData, function (response) {
                if (response.success) {
                    showNotification('Успешная авторизация! \nВы будете переадресованы через 1 секунду.', '');
                    VisibilityLoader(false);

                    setCookie('firstname', response.firstname);
                    setCookie('surname', response.surname);
                    setCookie('lastname', response.lastname);
                    setCookie('group', response.group);

                    logDebug(`auth success`)
                    setTimeout(function(){
                        window.location = "/";
                    }, 1000)
                } else {
                    showNotification(response.message, 'error');
                    VisibilityLoader(false);
                    logDebug(`auth error`)
                }
            }, function (xhr, status, error) {
                showNotification("Error: " + xhr.status + "\n" + error, 'error');
                VisibilityLoader(false);
            });
        });
    </script>
</main>