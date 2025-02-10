/*
# Welcome to WHYSPICE OS 0.0.1 (GNU/Linux 3.13.0.129-generic x86_64)

root@localhost:~ bash ./whyspice-work.sh
> Executing...

         _       ____  ____  _______ ____  ________________
        | |     / / / / /\ \/ / ___// __ \/  _/ ____/ ____/
        | | /| / / /_/ /  \  /\__ \/ /_/ // // /   / __/
        | |/ |/ / __  /   / /___/ / ____// // /___/ /___
        |__/|__/_/ /_/   /_//____/_/   /___/\____/_____/

                            Web Dev.
                WHYSPICE © 2024 # whyspice.su

> Disconnecting.

# Connection closed by remote host.
*/
function Redirect(url) {
    //window.location.href = url;
    swup.navigate(url);
    logDebug(`Redirecting to ${url}.`)
}

function Reload(){
    swup.navigate(window.location.pathname);
    logDebug(`Reloading page...`)
}

async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        logDebug(`Copied to clipboard.`)
    } catch (err) {
        logDebug(`Can't copy to clipboard: ${err}`)
    }
}

function SendAjax(url, data, successCallback, errorCallback) {
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        success: function (response) {
            if (typeof successCallback === 'function') {
                successCallback(response);
            }
        },
        error: function (xhr, status, error) {
            if (typeof errorCallback === 'function') {
                errorCallback(xhr, status, error);
            }
        }
    });
}


function showNotification(message, type)
{
    const sound_error = new Audio('./static/sound/alert_error.mp3');
    const sound_success = new Audio('./static/sound/alert_success.mp3');
    let audio, icon, vIcon;

    var notification = $('<div>').addClass('notification bg-green-500 bg-opacity-80 backdrop-blur-sm text-white');
    if (type === 'error') {
        notification.removeClass('bg-green-500').addClass('bg-red-700');
        audio = sound_error;
        icon = "<i class=\"fa-light fa-circle-exclamation\"></i>";
    }
    else if (type === 'warn') {
        notification.removeClass('bg-green-500').addClass('bg-yellow-600');
        audio = sound_error;
        icon = "<i class=\"fa-light fa-circle-exclamation\"></i>";
    }
    else {
        audio = sound_success;
        icon = "<i class=\"fa-light fa-bell\"></i>";
    }

    vIcon = $('<span>').addClass('notification-icon').html(icon);
    let messageElement = $('<div>').addClass('notification-message').text(message);
    messageElement.prepend(vIcon);
    notification.append(messageElement);

    let closeBtn = $('<span>').addClass('notification-close text-xl font-bold cursor-pointer').html('&times;');
    closeBtn.click(function() {
        notification.fadeOut(function() {
            notification.remove();
        });
    });
    notification.append(closeBtn);

    $('#notification-container').append(notification);
    audio.volume = 0.5;
    audio.play();

    logDebug('frontend: show notification')

    setTimeout(function() {
        notification.fadeOut(function() {
            notification.remove();
        });
    }, 5000);
}

function showModal(title, message) {
    $('#modalTitle').text(title);
    $('#modalMessage').html(message.replace(/\n/g, '<br>'));
    $('#modal').removeClass('hidden');
    logDebug('frontend: show modal')
}

function updateDate(){
    var now = new Date();
    var day = now.getDate();
    var monthNames = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"];
    var month = monthNames[now.getMonth()];
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    if (hours < 10) hours = '0' + hours;
    if (minutes < 10) minutes = '0' + minutes;
    if (seconds < 10) seconds = '0' + seconds;

    var formattedTime = day + ' ' + month + ', ' + hours + ':' + minutes + ':' + seconds;
    $('#now').text(formattedTime);
}


function simulateLoading() {
    const progress = $('.progress');
    progress.width('2%');
    $('#progress-bar').show();

    setTimeout(function () {
        progress.width('100%');
    }, 250);

    setTimeout(function () {
        $('#progress-bar').fadeOut(250);
    }, 500);
}

function SocketCheck(alert) {
    return new Promise((resolve) => {
        SendAjax('/api/socket_check', null, function(response) {
            if (response.success === true) {
                if (alert) {
                    showNotification('Соединение установлено | Ping: ' + response.message + ' ms');
                }
                logDebug(`socket: connection established (${response.message} ms)`, 'success')
                resolve(response.message);
            } else {
                if (alert) {
                    showNotification(response.message, 'error');
                }
                logDebug(`socket: connection failed - ${response.message}`, 'error')
                resolve(false);
            }
        });
    });
}

function SocketCMD(cmd) {
    SendAjax('/api/socket', {
        cmd: cmd
    }, function(response) {
        if (response.success == true) {
            logDebug(`socket: ${response.message}`)
        } else {
            logDebug(`socket: error executing command - ${response.message}`, 'error')
        }
    });
}

function changeActiveBar(){
    let currentUrl = window.location.pathname;
    let sidebarLinks = $('.menu-item');
    let tabSelected = false;
    $('.relative').find('#sidebar-active').remove();

    logDebug(`frontend: current path [ ${currentUrl} ]`)

    sidebarLinks.each(function() {
        let linkHref = $(this).attr('href').replace(/[./]/g, '');

        if (currentUrl.includes(linkHref) && linkHref !== "") {
            $(this).addClass("active");
            tabSelected = true
        }
        else {
            $(this).removeClass("active");
        }
    });

    if(tabSelected == false) {
        sidebarLinks.first().addClass("active");
    }
}

function setUpdateDate(){
    SendAjax('/api/get_latest_update', null, function (response) {
        if (response.success) {
            $('#updateDate').text(response.date);
            logDebug(`frontend: set update date - ${response.date}`)
        }
    });
}


function updateSocketStatus()
{
    SocketCheck(false).then(result => {
        if (result) {
            $('#socketServer').text(`доступен (${result}ms)`).removeClass('text-red-600').addClass('text-green-600');
            $('#serverUnavailable').addClass('hidden');
        } else {
            //showNotification('Сервер недоступен.', 'error');
            $('#socketServer').text('недоступен').removeClass('text-green-600').addClass('text-red-600');
            $('#serverUnavailable').removeClass('hidden');
        }
    });
}


function VisibilityLoader(status){
    if(status == true){
        $("#loader").fadeIn(250);
    }
    else if(status == false)
        $("#loader").fadeOut(500);
    else
        $("#loader").fadeOut(0);
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    logDebug(`app: set cookie - ${name}`)
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    logDebug(`app: getting cookie ${name}`)
    return null;
}

function checkIdentity() {
    const lastname = getCookie('lastname');
    const surname = getCookie('surname');
    const firstname = getCookie('firstname');
    const group = getCookie('group');

    if (!surname || !firstname) {
        $('#identityModal').removeClass('hidden');
        logDebug(`user: checking identity`)
    } else {
        logDebug(`user: ${lastname} ${firstname} ${surname} [${group}]`)
        $('#username').text(firstname + " " + surname);
        logDebug(`frontend: set username`)
    }
}

function renewIdentity() {
    $('#identityModal').removeClass('hidden');
    logDebug(`user: renew identity`)
}

function logDebug(message, type = '') {
    if (!$('#debug-console').length)
        return;
    const timestamp = new Date().toLocaleTimeString();
    let colorClass = '';

    switch (type) {
        case 'error':
            colorClass = 'text-red-500';
            break;
        case 'warn':
            colorClass = 'text-yellow-500';
            break;
        case 'success':
            colorClass = 'text-green-500';
            break;
        default:
            colorClass = 'text-gray-300';
            break;
    }

    const logMessage = `
            <div class="text-sm ${colorClass}">
                <span class="text-gray-500">[${timestamp}]</span> ${message}
            </div>
        `;

    $('#debug-console').append(logMessage);
    $('#debug-console').scrollTop($('#debug-console')[0].scrollHeight);
}




