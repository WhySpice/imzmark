<div id="updateModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
        <h2 class="text-xl font-semibold mb-4">Добавить обновление</h2>
        <form method="post">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Заголовок</label>
                <input type="text" id="header" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Содержимое</label>
                <textarea id="content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" rows="3"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeUpdateModal" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Закрыть</button>
                <button type="button" id="addUpdate" class="bg-green-500 text-white px-4 py-2 rounded">Сохранить</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        function openUpdateModal() {
            $('#updateModal').removeClass('hidden');
        }

        function closeUpdateModal() {
            $('#updateModal').addClass('hidden');
        }

        $('#openUpdateModal').click(function() {
            openUpdateModal();
        });

        $('#closeLineModal').click(function() {
            closeUpdateModal();
        });

        $('#addUpdate').click(function() {
            VisibilityLoader(true);
            SendAjax('/api/add_update', {
                header: $('#header').val(),
                content: $('#content').val()
            }, function(response) {
                if (response.success) {
                    showNotification(response.message, '');
                    VisibilityLoader(false);
                    Reload();
                }
                else {
                    showNotification(response.message, 'error');
                    VisibilityLoader(false);
                }
            });
        });
    });
</script>