<div id="userModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
        <h2 class="text-xl font-semibold mb-4">Добавить пользователя</h2>
        <form id="userForm">
            <div class="mb-4">
                <label for="lastName" class="block text-sm font-medium text-gray-700">Фамилия</label>
                <input type="text" id="lastName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" required>
            </div>
            <div class="mb-4">
                <label for="firstName" class="block text-sm font-medium text-gray-700">Имя</label>
                <input type="text" id="firstName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" required>
            </div>
            <div class="mb-4">
                <label for="surName" class="block text-sm font-medium text-gray-700">Отчество</label>
                <input type="text" id="surName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" required>
            </div>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Логин</label>
                <input type="text" id="create_username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 border" readonly>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                <div class="flex">
                    <input type="text" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" required>
                    <button type="button" id="generatePassword" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">Генерировать</button>
                </div>
            </div>
            <div class="mb-4">
                <label for="accessRights" class="block text-sm font-medium text-gray-700">Права доступа</label>
                <select id="accessRights" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border">
                    <option>Администратор</option>
                    <option>Маркировщик</option>
                    <option>ВСД</option>
                    <option>Цех</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeUserModal" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Закрыть</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Сохранить</button>
            </div>
        </form>
    </div>
</div>
<script>
    function openUserModal() {
        $('#userModal').removeClass('hidden');
    }

    function closeUserModal() {
        $('#userModal').addClass('hidden');
    }

    function generatePassword() {
        const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let password = '';
        for (let i = 0; i < 6; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        $('#password').val(password);
    }

    function transliterate(text) {
        const translitMap = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 'з': 'z', 'и': 'i', 'й': 'y',
            'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f',
            'х': 'kh', 'ц': 'ts', 'ч': 'ch', 'ш': 'sh', 'щ': 'shch', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya'
        };
        return text.split('').map(char => translitMap[char] || char).join('');
    }

    function generateUsername() {
        const firstName = $('#firstName').val().toLowerCase();
        const lastName = $('#lastName').val().toLowerCase();
        const surName = $('#surName').val().toLowerCase();
        const username = transliterate(firstName.charAt(0) + surName.charAt(0) + lastName);
        $('#create_username').val(username);
    }
    $(document).ready(function() {
        $('#openUserModal').click(function() {
            openUserModal();
        });

        $('#closeUserModal').click(function() {
            closeUserModal();
        });

        $('#generatePassword').click(function() {
            generatePassword();
        });

        $('#firstName, #lastName, #surName').on('input', function() {
            generateUsername();
        });

        $('#userForm').submit(function(event) {
            event.preventDefault();
            closeUserModal();
        });
    });
</script>
