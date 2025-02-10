<?php
User::needAuth();
?>
<div class="bg-white rounded-lg shadow-sm p-6 transition-fade" id="swup">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Часто задаваемые вопросы</h1>
    <div class="space-y-4">
        <div class="faq-item bg-white rounded-2xl shadow-lg p-6 transition duration-300 hover:shadow-xl">
            <h3 class="text-xl font-bold text-gray-800 cursor-pointer">
                <i class="fas fa-plus mr-2"></i>Что значит "Сервер недоступен"?
            </h3>
            <p class="text-gray-600 mt-3 hidden">В данном случае приложение не может подключиться к серверу, который взаимодействует с API "Честный знак". Задания в очереди не будут обрабатываться.</p>
        </div>
        <div class="faq-item bg-white rounded-2xl shadow-lg p-6 transition duration-300 hover:shadow-xl">
            <h3 class="text-xl font-bold text-gray-800 cursor-pointer">
                <i class="fas fa-plus mr-2"></i>Что делать, если пишет "Сервер недоступен"?
            </h3>
            <p class="text-gray-600 mt-3 hidden">Первым делом, подождите 15 минут. Если в течении этого времени сервер все также недоступен - напишите разработчику системы для того, чтобы сервер был запущен.</p>
        </div>
        <div class="faq-item bg-white rounded-2xl shadow-lg p-6 transition duration-300 hover:shadow-xl">
            <h3 class="text-xl font-bold text-gray-800 cursor-pointer">
                <i class="fas fa-plus mr-2"></i>Что делать, если партия очень долго вводится в оборот?
            </h3>
            <p class="text-gray-600 mt-3 hidden">Первым делом проверьте состояние платформ "Честного знака", затем проверьте отзывы пользователей о работе системы. Если партия не грузится более полутора часов - обратитесь к разработчику.</p>
        </div>
        <div class="faq-item bg-white rounded-2xl shadow-lg p-6 transition duration-300 hover:shadow-xl">
            <h3 class="text-xl font-bold text-gray-800 cursor-pointer">
                <i class="fas fa-plus mr-2"></i>Что делать, если выходят ошибки при вводе в оборот или отчете о нанесении?
            </h3>
            <p class="text-gray-600 mt-3 hidden">
                Первым делом проверьте состояние платформ "Честного знака", затем проверьте отзывы пользователей о работе системы. <br/>
                Если жалоб на сервисы нет, проверьте список ошибок.
                Если ругается на даты, GTIN и тому подобное - внимательно проверьте даты производства и срока годности, GTIN (На платформе Меркурий, и в Честном знаке).
            </p>
        </div>
    </div>
    <script>
        $('.faq-item h3').click(function() {
            $(this).next('p').slideToggle();
            $(this).find('i').toggleClass('fa-plus fa-minus');
        });
    </script>

    <div class="container mx-auto grid mt-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Поддержка</h1>

        <div class="flex justify-between square">
            <div style="background-color: rgba(59, 130, 246, 0.1);" class="w-full flex flex-col items-center p-4 text-gray-600 dark:text-gray-400 rounded-lgc relative hover:dashed">
                <i class="fas fa-trademark fa-fw" style="z-index: 0; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); font-size: 250px; opacity: 0.05;"></i>
                <div class="z-1 flex flex-col items-center justify-center h-full">
                    <h2 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-auto">
                        Честный знак
                    </h2>
                    <div class="mt-2 p-3 text-gray-700 dark:text-gray-100 w-full text-center">
                        <span class="font-semibold">
                            <span class="font-bold">Почта:</span><br/>
                            support@crpt.ru <br/>
                            <span class="font-bold">Горячая линия:</span><br/>
                            8 800 222 1523
                        </span>
                    </div>
                </div>
            </div>

            <div style="background-color: rgba(59, 130, 246, 0.1);" class="w-full ml-2 flex flex-col items-center p-4 text-gray-600 dark:text-gray-400 rounded-lgc relative hover:dashed">
                <i class="far fa-farm fa-fw" style="z-index: 0; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); font-size: 250px; opacity: 0.05;"></i>
                <div class="z-1 flex flex-col items-center justify-center h-full">
                    <h2 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-auto">
                        Меркурий
                    </h2>
                    <div class="mt-2 p-3 text-gray-700 dark:text-gray-100 w-full text-center">
                        <span class="font-semibold">
                            <span class="font-bold">Почта:</span><br/>
                            mercury@fsvps.ru <br/>
                            <span class="font-bold">Горячая линия:</span><br/>
                            8 492 252 9929
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
