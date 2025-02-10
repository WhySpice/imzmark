let cryptopro_status = false;

function formatDate(dateString) {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}.${month}.${year}`;
}

function extractName(subjectName) {
    const cnMatch = subjectName.match(/CN=([^,]+)/);
    return cnMatch ? cnMatch[1] : 'Неизвестный владелец';
}


function checkCadesPlugin() {
    if (typeof cadesplugin === 'undefined') {
        showModal('Ошибка!', 'Расширение КриптоПРО ЭЦП Browser Plug-in не установлено. \n\nДля продолжения работы, необходимо его необходимо установить.');
        return false;
    }
    return true;
}
function checkCertificate(certSerial) {
    cadesplugin.async_spawn(function*() {
        try {
            var oStore = yield cadesplugin.CreateObjectAsync("CAdESCOM.Store");
            yield oStore.Open(cadesplugin.CAPICOM_CURRENT_USER_STORE, cadesplugin.CAPICOM_MY_STORE, cadesplugin.CAPICOM_STORE_OPEN_MAXIMUM_ALLOWED);
            var certs = yield oStore.Certificates;
            var count = yield certs.Count;
            var certFound = false;

            for (var i = 1; i <= count; i++) {
                var cert = yield certs.Item(i);
                var serialNumber = yield cert.SerialNumber;
                if (serialNumber === certSerial) {
                    certFound = true;
                    var subjectName = yield cert.SubjectName;
                    var validToDate = yield cert.ValidToDate;
                    $('#signatureOwner').text(extractName(subjectName)).removeClass('text-red-600').addClass('text-gray-600');
                    $('#signatureExpires').text(`(до ${formatDate(validToDate)})`);
                    cryptopro_status = true;
                    break;
                }
            }

            yield oStore.Close();

            if (!certFound) {
                showModal('Ошибка!', 'Сертификат не найден. \nИскомый серийный номер:\n' + certId);
            }
        } catch (err) {
            showModal('Ошибка!', 'Ошибка при проверке сертификата: \n' + err.message);
        }
    });
}

function signData(certSerial, dataToSign) {
    return cadesplugin.async_spawn(function*() {
        try {
            console.log('[CADES] Начинаю процесс подписи данных.');
            console.log('[CADES] Открытие хранилища сертификатов.');
            var oStore = yield cadesplugin.CreateObjectAsync("CAdESCOM.Store");
            yield oStore.Open(cadesplugin.CAPICOM_CURRENT_USER_STORE, cadesplugin.CAPICOM_MY_STORE, cadesplugin.CAPICOM_STORE_OPEN_MAXIMUM_ALLOWED);
            var certs = yield oStore.Certificates;
            var count = yield certs.Count;
            var cert = null;

            console.log('[CADES] Поиск сертификата.');
            for (var i = 1; i <= count; i++) {
                var tempCert = yield certs.Item(i);
                var serialNumber = yield tempCert.SerialNumber;
                if (serialNumber === certSerial) {
                    cert = tempCert;
                    break;
                }
            }

            if (!cert) {
                showModal('Ошибка!', 'Сертификат не найден. \nИскомый серийный номер:\n' + certSerial);
                return null;
            }

            console.log('[CADES] Сертификат найден.');

            var oSigner = yield cadesplugin.CreateObjectAsync("CAdESCOM.CPSigner");
            yield oSigner.propset_Certificate(cert);

            var oSignedData = yield cadesplugin.CreateObjectAsync("CAdESCOM.CadesSignedData");
            yield oSignedData.propset_ContentEncoding(cadesplugin.CADESCOM_BASE64_TO_BINARY);

            // Преобразование данных в Base64
            var base64Data = btoa(dataToSign);
            yield oSignedData.propset_Content(base64Data);

            console.log('[CADES] Подписание данных.');
            var sSignedMessage = yield oSignedData.SignCades(oSigner, cadesplugin.CADESCOM_CADES_BES);

            console.log('[CADES] Успешное подписание.');
            return sSignedMessage;
        } catch (err) {
            showModal('Ошибка!', 'Ошибка при подписании данных: \n' + err.message);
            throw err;
        }
    });
}

async function getSignedData(certSerial, dataToSign) {
    const signedMessage = await signData(certSerial, dataToSign);
    return signedMessage;
}

function checkQueue() {
    SendAjax('/api/cades_query', { action: 'check_queue' }, async function (response) {
        if (response.data) {
            console.log('[CADES] Получил запрос от сервера на подписание данных.');
            const signedData = await getSignedData(certSerial, response.data);
            sendSignedData(response.queue_id, signedData);
        }
    });
}

function sendSignedData(queue_id, signedData) {
    SendAjax('/api/cadesQuery', {
        action: 'update_queue',
        queue_id: queue_id,
        signed_data: signedData
    }, function(response) {
        if (response.status === 'success') {
            console.log('[CADES] Подписал данные, полученные от сервера.');
        } else {
            console.error('[CADES] Не смог обновить очередь на подписание: ', response.message);
        }
    });
}

$(document).ready(function() {
    cadesplugin.then(
        function() {
            if (checkCadesPlugin()) {
                checkCertificate(certSerial);
                //setInterval(checkQueue, 3000);
            }
        },
        function(error) {
            showModal('Ошибка!', 'Не найдено расширение КриптоПРО ЭЦП Browser Plug-in. \nДля дальнейшей работы, необходимо его установить.')
        }
    );
});
