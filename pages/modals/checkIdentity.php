<div id="identityModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 backdrop-blur-sm flex justify-center items-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-lg font-semibold text-gray-800">Подтвердите вашу личность</h2>
        <p class="text-sm text-gray-600">Для дальнейшей идентификации работника на общей учетной записи, необходимо заполнить поля:</p>
        <form id="identityForm">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Имя</label>
                <input type="text" id="name" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="surname" class="block text-sm font-medium text-gray-700">Фамилия</label>
                <input type="text" id="surname" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 focus:outline-none">Подтвердить</button>
            </div>

            <p class="text-sm text-center text-gray-500 mt-1">
                Аккаунт:
                <span class="text-gray-400"><?= User::Me()->username ?></span>
                <a class="text-red-400 font-medium" href="/logout">(выйти)</a>
            </p>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#identityForm').on('submit', function(e) {
            e.preventDefault();

            const surname = $('#surname').val();
            const firstname = $('#firstname').val();

            if (surname && firstname) {
                setCookie('surname', surname, 1);
                setCookie('firstname', firstname, 1);

                $('#username').text(firstname + " " + surname);

                $('#identityModal').addClass('hidden');
            }
        });
    })
</script>
