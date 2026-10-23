document.cookie = 'DemoCookieBar=demo; SameSite=Strict';

// La cookieBAR aggiunge listener di scroll che non espone: li teniamo da parte mentre
// l'anteprima viene generata, per poterli rimuovere quando la si rigenera
var previewBusy = false;
var previewScrollListeners = [];
var addEventListenerOriginal = window.addEventListener;
window.addEventListener = function(type, listener) {
    if (previewBusy && type === 'scroll') {
        previewScrollListeners.push(listener);
    }
    return addEventListenerOriginal.apply(this, arguments);
};

$(document).ready(function() {
    var cookieBarScript = document.getElementById('cookiebar-script');
    var previewPending = false;
    var previewDebounce = null;
    var previewTimeout = null;
    var consentMessages = {
        CookieAllowed: 'The cookieBAR is hidden because you have already accepted cookies on this website.',
        CookieDisallowed: 'The cookieBAR is hidden because you have already declined cookies on this website.',
        CookieCustomized: 'The cookieBAR is hidden because you have already customized your cookie preferences on this website.'
    };

    loadConfiguration();

    $('select').formSelect();
    $('.tabs').tabs();
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    M.updateTextFields();
    reconfigure();

    $(window).on('scroll', updateConsentNotice);
    document.addEventListener('cookiebarConsent', updateConsentNotice);
    watchCookieBar();

    // Al caricamento la cookieBAR parte da sola (con la configurazione della querystring)
    if (getConsent() === undefined) {
        startPreview();
    }
    updateConsentNotice();

    $(".tab a").on('click', function() {
        var hash = $(this).attr('href');
        history.replaceState(null, '', hash);
    });

    $("a.tabopener").on('click', function(e) {
        e.preventDefault();
        var hash = $(this).attr('href');
        M.Tabs.getInstance($('.tabs')[0]).select(hash.substring(1));
        history.replaceState(null, '', hash);
        $('.tabs')[0].scrollIntoView({ behavior: 'smooth' });
    });

    $('.configurator').on('change input', function() {
        reconfigure();
        updateUrl();
        clearTimeout(previewDebounce);
        previewDebounce = setTimeout(renderPreview, 400);
    });

    $('.consentNoticeShow').on('click', function(e) {
        e.preventDefault();
        resetConsent();
        renderPreview();
    });

    // Imposta i campi del configuratore in base ai parametri passati in querystring
    function loadConfiguration() {
        var urlParams = new URLSearchParams(params);

        $('.configurator').each(function() {
            var element = $(this);
            var name = element.attr('id');

            if (element.attr('type') === 'checkbox') {
                element.prop('checked', urlParams.has(name));
            } else {
                element.val(urlParams.get(name) || '');
            }
        });
    }

    function reconfigure() {
        var separator = '?';
        var baseUrlOpen = $('.configuratorBaseUrlOpen').html();
        var baseUrl = $('.configuratorBaseUrl').html();
        var baseUrlClose = $('.configuratorBaseUrlClose').html();

        $('.configurator').each(function() {
        var element = $(this);
        var name = element.attr('id');
        var value = element.val();
        var tagName = element.prop('tagName');

        if (tagName === 'INPUT' && element.is(':checked')) {
            baseUrl = baseUrl + separator + name + '=' + value;
            separator = '&';
        }
        if (tagName === 'INPUT' && element.attr('type') === 'text' && $.trim(value) !== '') {
            baseUrl = baseUrl + separator + name + '=' + encodeURIComponent(value);
            separator = '&';
        }
        if (tagName === 'SELECT' && element.val()) {
            baseUrl = baseUrl + separator + name + '=' + value;
            separator = '&';
        }
        });
        params = baseUrl.split('?')[1] || '';

        $('.configuratorTag').html(baseUrlOpen + baseUrl + baseUrlClose);
    }

    // Mantiene la configurazione nell'URL, così la pagina si può ricaricare o condividere
    function updateUrl() {
        history.replaceState(null, '', window.location.pathname + (params ? '?' + params : '') + window.location.hash);
    }

    function getConsent() {
        var match = document.cookie.match(/(?:^|;\s*)cookiebar=([^;]*)/);
        return match ? decodeURI(match[1]) : undefined;
    }

    function resetConsent() {
        ['cookiebar', 'cookiebar-tracking', 'cookiebar-third-party'].forEach(function(name) {
            document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/';
        });
        document.cookie = 'DemoCookieBar=demo; SameSite=Strict';
        updateConsentNotice();
    }

    function updateConsentNotice() {
        var consent = getConsent();

        if (consent === undefined) {
            $('.consentNotice').addClass('hidden');
            return;
        }
        $('.consentNoticeText').text((consentMessages[consent] || consentMessages.CookieAllowed) + ' Show it again to preview your configuration.');
        $('.consentNotice').removeClass('hidden');
    }

    // Rigenera la cookieBAR della pagina con la configurazione corrente.
    // Le generazioni sono serializzate: la cookieBAR lavora in modo asincrono e non può essere interrotta
    function renderPreview() {
        if (previewBusy) {
            previewPending = true;
            return;
        }
        if (getConsent() !== undefined) {
            updateConsentNotice();
            return;
        }

        // Via la barra precedente prima di generarne una nuova: la cookieBAR cerca i propri elementi per id
        previewScrollListeners.forEach(function(listener) {
            window.removeEventListener('scroll', listener);
        });
        previewScrollListeners = [];
        $(document.body).children('div').filter(function() {
            return $(this).find('#cookie-bar').length > 0;
        }).remove();
        $('link[href*="themes/cookiebar"]').remove();
        document.body.style.marginTop = '';
        document.body.style.marginBottom = '';

        // La cookieBAR legge la configurazione dall'src del proprio script tag.
        // Nell'anteprima la geolocalizzazione è sempre saltata, così la barra si vede subito ovunque
        var previewParams = params ? params.split('&') : [];
        if (previewParams.indexOf('noGeoIp=1') < 0) {
            previewParams.push('noGeoIp=1');
        }
        cookieBarScript.setAttribute('src', cookieBarScript.getAttribute('src').replace(/\?.*$/, '') + '?' + previewParams.join('&'));

        startPreview();
        setupCookieBar();
    }

    function startPreview() {
        previewBusy = true;
        // Senza cookie e senza "always" la cookieBAR non compare: dopo un po' la generazione si considera conclusa
        previewTimeout = setTimeout(previewDone, 3000);
    }

    function previewDone() {
        clearTimeout(previewTimeout);
        if (!previewBusy) {
            return;
        }
        previewBusy = false;
        updateConsentNotice();

        if (previewPending) {
            previewPending = false;
            renderPreview();
        }
    }

    // La generazione è conclusa quando la cookieBAR aggiunge il proprio markup e ha calcolato
    // il margine del body (lo fa dopo 300ms)
    function watchCookieBar() {
        new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1 && node.querySelector('#cookie-bar')) {
                        setTimeout(previewDone, 350);
                    }
                });
            });
        }).observe(document.body, { childList: true });
    }

    $.fn.selectText = function(){
        var doc = document;
        var element = this[0];
        if (doc.body.createTextRange) {
            var range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    };

    $('code').on('click', function() {
        $(this).selectText();
    });
});
