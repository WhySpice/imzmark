<div id="debug-menu" style="z-index: 10" class="fixed bottom-0 left-0 w-full bg-gray-500 bg-opacity-60 backdrop-blur-sm text-white shadow-lg p-4 hidden">
    <div class="flex justify-between items-center">
        <span class="font-semibold">
            <i class="fad fa-bug"></i>
            DEBUG MODE
        </span>
        <button id="debug-close" class="text-sm text-red-500 hover:text-red-300 px-3 py-1">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div id="debug-console" class="mt-4 bg-gray-900 bg-opacity-60 rounded p-2 h-32 overflow-y-auto border border-gray-700">

    </div>
    <div class="flex items-center mt-2">
        <input
                id="debug-input"
                class="w-full px-4 py-2 bg-gray-900 bg-opacity-60 rounded border border-gray-700 outline-none"
                type="text"
                placeholder=""
        />
        <div id="debug-autocomplete" class="hidden fixed left-0 w-full max-h-40 overflow-y-auto bg-gray-600 list-none z-50">
            <ul>
            </ul>
        </div>
        <button id="execute-command" class="ml-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg text-white">
            <i class="fas fa-arrow-alt-right"></i>
        </button>
    </div>
    <div class="mt-2 inline-flex space-x-1 text-xs">
        <button id="debug-clear-console" class="bg-blue-500 hover:bg-blue-600 p-1 rounded">
            <i class="fas fa-trash"></i>
        </button>
        <button id="debug-add-admin" class="bg-red-500 hover:bg-red-600 p-1 rounded">
            addadmin
        </button>
        <button id="debug-test-log" class="bg-red-500 hover:bg-red-600 p-1 rounded">
            testlog
        </button>
        <button id="debug-test-notification" class="bg-red-500 hover:bg-red-600 p-1 rounded">
            testnotification
        </button>
        <button id="debug-test-modal" class="bg-red-500 hover:bg-red-600 p-1 rounded">
            testmodal
        </button>
        <button id="debug-check-socket" class="bg-red-500 hover:bg-red-600 p-1 rounded">
            checksocket
        </button>
    </div>
</div>

<div style="" class="fixed bottom-4 right-4">
    <div class="inline-block bg-red-500 text-white text-xs text-center bg-opacity-30 backdrop-blur-sm rounded-lg p-2">
        <p class="font-bold">DEBUG MODE</p>
        <div style="font-size: 8px;" class="text-left">
            <p>> PHP: <?= phpversion() ?></p>
            <p>> TZ: <?= date_default_timezone_get() ?></p>
        </div>
    </div>
</div>
<button id="debug-open" style="bottom: 5.5rem;" class="fixed right-4 bg-red-500 shadow-md bg-opacity-30 hover:bg-red-500 transition duration-300 text-white text-xs px-2 py-1 rounded-full shadow-lg">
    <i class="fad fa-bug"></i>
</button>
