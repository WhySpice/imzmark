<ul class="mt-3">
    <? if(User::CheckAuth()) : ?>
    <li>
        <a href="/" class="menu-item active flex items-center px-4 py-3 text-gray-700">
            <i class="fa-sharp-duotone fa-solid fa-house fa-fw mr-2"></i>
            Дэшборд
        </a>
    </li>
    <li>
        <a href="/input" class="menu-item active flex items-center px-4 py-3 text-gray-700">
            <i class="fa-solid fa-arrow-up-wide-short fa-fw mr-2"></i>
            Ввод в оборот
        </a>
    </li>
    <li>
        <a href="/order" class="menu-item flex items-center px-4 py-3 text-gray-700">
            <i class="fa-solid fa-send-backward fa-fw mr-2"></i>
            Заказ кодов
        </a>
    </li>
    <li>
        <a href="/lines" class="menu-item flex items-center px-4 py-3 text-gray-700">
            <i class="fa-solid fa-line-columns fa-fw mr-2"></i>
            Линии
        </a>
    </li>
    <li>
        <a href="/products" class="menu-item flex items-center px-4 py-3 text-gray-700">
            <i class="fa-solid fa-sitemap fa-fw mr-2"></i>
            Продукция
        </a>
    </li>
    <li>
        <a href="/users" class="menu-item flex items-center px-4 py-3 text-gray-700">
            <i class="fa-solid fa-users fa-fw mr-2"></i>
            Пользователи
        </a>
    </li>
    <li>
        <a href="/settings" class="menu-item flex items-center px-4 py-3 text-gray-700">
            <i class="fas fa-tools fa-fw mr-2"></i>
            Настройки
        </a>
    </li>
    <li>
        <a href="/support" class="menu-item flex items-center px-4 py-3 text-gray-700">
            <i class="fas fa-question-circle fa-fw mr-2"></i>
            Помощь
        </a>
    </li>

    <? else : ?>
        <li>
            <a href="/auth" class="menu-item flex items-center px-4 py-3 text-gray-700">
                <i class="far fa-right-to-bracket fa-fw mr-2"></i>
                Авторизация
            </a>
        </li>
        <li>
            <a href="/forgot-password" class="menu-item flex items-center px-4 py-3 text-gray-700">
                <i class="far fa-unlock fa-fw mr-2"></i>
                Восстановление пароля
            </a>
        </li>
        <li>
            <a href="/request-access" class="menu-item flex items-center px-4 py-3 text-gray-700">
                <i class="far fa-user-unlock fa-fw mr-2"></i>
                Запросить доступ
            </a>
        </li>
    <? endif; ?>
</ul>