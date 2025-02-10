<?php
User::needntAuth();

$c = R::findOne('userinvites', 'invite_code = ?', [$code]);
if(!$c || $c->activated_by)
    Utils::RedirectJS('/');
?>

<main class="h-full overflow-y-auto transition-fade" id="swup">
    <div class="flex items-center p-6">
        <div class="flex-1 h-full max-w-xl mx-auto overflow-hidden rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto">
                <div class="flex items-center justify-center p-6 sm:p-12">
                    <div class="w-full">
                        <form method="post">
                            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                                Register
                            </h1>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Username</span>
                                <input id="username" type="text"
                                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required
                                       autocomplete="false" placeholder="">
                            </label>
                            <label class="block text-sm mt-2">
                                <span class="text-gray-700 dark:text-gray-400">E-mail</span>
                                <input id="email" type="email"
                                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required
                                       autocomplete="false" placeholder="">
                            </label>
                            <label class="block text-sm mt-2">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input id="password" type="password"
                                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                       required placeholder="">
                            </label>
                            <label class="block text-sm mt-2">
                                <span class="text-gray-700 dark:text-gray-400">Repeat password</span>
                                <input id="try_password" type="password"
                                       class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                       focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                       dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                       required placeholder="">
                            </label>

                            <button type="button" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Register
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('button[type="button"]').click(function () {
            VisibilityLoader(true);
            var formData = {
                username: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                try_password: $('#try_password').val(),
                invite_code: '<?= $code ?>'
            };

            SendAjax('/api/register', formData, function (response) {
                if (response.success) {
                    showNotification(response.message, '');
                    VisibilityLoader(false);
                    Redirect('/auth')
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