<div id="lineModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
        <h2 class="text-xl font-semibold mb-4">Добавить линию</h2>
        <form method="post">
            <div class="mb-4">
                <label for="lineNumber" class="block text-sm font-medium text-gray-700">Номер линии</label>
                <input type="number" id="lineNumber" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" required>
            </div>
            <div class="mb-4">
                <label for="comment" class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea id="comment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm border" rows="3"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeLineModal" class="bg-red-500 text-white px-4 py-2 rounded mr-2">Закрыть</button>
                <button type="button" id="addLine" class="bg-green-500 text-white px-4 py-2 rounded">Сохранить</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        function openLineModal() {
            $('#lineModal').removeClass('hidden');
        }

        function closeLineModal() {
            $('#lineModal').addClass('hidden');
        }

        $('#openLineModal').click(function() {
            openLineModal();
        });

        $('#closeLineModal').click(function() {
            closeLineModal();
        });

        $('#addLine').click(function() {
            VisibilityLoader(true);
            SendAjax('/api/add_line', {
                line: $('#lineNumber').val(),
                comment: $('#comment').val()
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