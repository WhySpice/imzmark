let isInitialized = false;

$(document).ready(function() {
    setInterval(updateDate, 1000);
    $('#closeModal').click(function() {
        $('#modal').addClass('hidden');
    });
});

function init(){
    if (!isInitialized)
    {
        updateDate();
        setUpdateDate();
        SocketCMD('sysinfo');
        logDebug('app initialized', 'success');
        isInitialized = true;
    }

    simulateLoading();
    changeActiveBar();

    //updateSocketStatus();

    VisibilityLoader(false);
}

const swup = new Swup({
    plugins: [
        new SwupScriptsPlugin(
            {
                head: false,
                body: true,
                optin: false
            })

    ]
});

document.addEventListener('DOMContentLoaded', () => init());
swup.hooks.on('visit:start', (visit) => {
    VisibilityLoader(true);
    visit.cache.read = false;
});
swup.hooks.on('page:view', () => init());