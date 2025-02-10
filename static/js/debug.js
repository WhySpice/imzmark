function showAutocomplete(matches) {
    const $autocomplete = $("#debug-autocomplete");
    $autocomplete.empty();

    if (matches.length === 0) {
        $autocomplete.addClass("hidden");
        return;
    }

    matches.forEach((match) => {
        const item = `<li class="px-4 py-2 hover:bg-gray-700 cursor-pointer">${match + "();"}</li>`;
        $autocomplete.append(item);
    });

    const input = $("#debug-input")[0];
    const inputRect = input.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
    const spaceBelow = viewportHeight - inputRect.bottom;
    const spaceAbove = inputRect.top;

    if (spaceBelow < 150 && spaceAbove > spaceBelow) {
        $autocomplete.css({
            top: "auto",
            bottom: "100%",
        });
    } else {
        $autocomplete.css({
            top: `${inputRect.bottom + window.scrollY}px`,
            bottom: "auto",
        });
    }

    $autocomplete.removeClass("hidden");
}


function hideAutocomplete() {
    $("#debug-autocomplete").addClass("hidden");
}

function clear() {
    const $console = $("#debug-console");
    if ($console.length) {
        $console.empty();
        logDebug("### Debug console cleared. ###", "success");
    }
}

$(document).ready(function() {
    logDebug('init debug mode', 'warn')
    $('#debug-open').on('click', function () {
        $('#debug-menu').slideDown();
        $(this).fadeOut();
        $('#debug-console').scrollTop($('#debug-console')[0].scrollHeight);
    });
    $('#debug-close').on('click', function () {
        $('#debug-menu').slideUp();
        $('#debug-open').fadeIn();
    });

    $('#debug-clear-console').on('click', function () {
        clear();
    });
    $('#debug-add-admin').on('click', function () {
        SendAjax('/api/debug/addadmin', null, function (response) {
            if (response.success) {
                logDebug(`> addadmin`)
                logDebug(`addadmin: created`, 'success')
            }
            else {
                logDebug(`> addadmin`)
                logDebug(`addadmin: ${response.message}`, 'error')
            }
        });
    });
    $('#debug-test-log').on('click', function () {
        logDebug('> testlog');
        logDebug('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'success');
    });
    $('#debug-test-notification').on('click', function () {
        logDebug('> testnotification');
        showNotification('notification test');
    });
    $('#debug-test-modal').on('click', function () {
        logDebug('> testmodal');
        showModal('modal test', 'testing');
    });
    $('#debug-check-socket').on('click', function () {
        logDebug('> checksocket');
        SocketCheck();
    });

    const debugFunctions = Object.keys(window)
        .filter((key) => typeof window[key] === "function" && !key.startsWith("on"));

    $("#debug-input").on("input", function () {
        const query = $(this).val().trim();
        if (!query) {
            hideAutocomplete();
            return;
        }

        const matches = debugFunctions.filter((fn) => fn.startsWith(query));
        showAutocomplete(matches);
    });

    $("#debug-autocomplete").on("click", "li", function () {
        $("#debug-input").val($(this).text());
        hideAutocomplete();
    });

    $("#debug-input").on("blur", function () {
        setTimeout(hideAutocomplete, 100);
    });

    $("#execute-command").on("click", function () {
        const command = $("#debug-input").val();
        if (!command.trim()) return;

        try {
            logDebug(`> ${command}`);
            const result = eval(command);
        } catch (err) {
            logDebug(`${err.message}`, "error");
        }

        $("#debug-input").val("");
    });

    $("#debug-input").on("keypress", function (e) {
        if (e.key === "Enter") {
            $("#execute-command").click();
        }
    });
});