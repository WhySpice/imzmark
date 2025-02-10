<?php
User::needntAuth();
?>

<main class="h-full overflow-y-auto transition-fade" id="swup">
    <div class="flex items-center justify-between p-4 text-sm font-semibold text-white bg-blue-600 shadow-md">
        <div class="flex items-center">
            <i class="fa-light fa-triangle-exclamation mr-2"></i>
            <span>Если у вас не привязан E-mail к учетной записи, обратитесь к вашему руководителю.</span>
        </div>
    </div>
    <div class="flex items-center p-6 main">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img class="object-cover w-full h-full block" src="/static/img/auth_splash.jpg">
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50" role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                В данный момент, данная функция недоступна...
                            </div>
                        </div>
                        <form method="post">
                            <h1 class="mb-4 text-xl font-semibold text-gray-600">
                                Восстановление пароля
                            </h1>
                            <label class="block text-sm mb-2">
                                <span class="text-gray-700">Логин</span>
                                <input id="username" type="text" class="block w-full p-2 bg-gray-50 border border-gray-300 rounded-md" required autocomplete="false">
                            </label>

                            <button type="button" class="block w-full bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition duration-300">
                                Отправить
                            </button>

                            <a class="block border border-blue-300 text-blue-300 p-1 rounded-md hover:bg-blue-300 hover:text-white transition duration-300 mt-2" href="/auth">
                                <i class="fas fa-arrow-left fa-fw mr-2"></i>
                                Назад
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

            SendAjax('./api/forgot-password', formData, function (response) {
                if (response.success) {
                    showNotification('Check your E-mail.', '');
                    VisibilityLoader(false);
                } else {
                    showNotification(response.message, 'error');
                    VisibilityLoader(false);
                }
            }, function (xhr, status, error) {
                showNotification("Error: " + xhr.status + "\n" + error, 'error');
                VisibilityLoader(false);
            });
        });
    </script>
</main>