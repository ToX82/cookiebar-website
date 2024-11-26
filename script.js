document.cookie = 'DemoCookieBar=demo; SameSite=Strict';

$(document).ready(function() {
    $('select').formSelect();
    $('.tabs').tabs();
    $('.collapsible').collapsible();
    $('.tooltipped').tooltip();
    reconfigure();

    $(".tab a, a.tabopener").on('click', function() {
        var hash = $(this).attr('href');
        window.location.hash = hash;
    });

    $('.configurator').on('change', function() {
        reconfigure();
    });

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
        if (tagName === 'INPUT' && element.attr('type') === 'text' && element.val().length > 1) {
            baseUrl = baseUrl + separator + name + '=' + encodeURIComponent(value);
            separator = '&';
        }
        if (tagName === 'SELECT' && element.val()) {
            baseUrl = baseUrl + separator + name + '=' + value;
            separator = '&';
        }
        });
        demoUrl = baseUrl.replace('cookiebar-latest.min.js', '');

        $('.configuratorTag').html(baseUrlOpen + baseUrl + baseUrlClose);
        $('.configuratorDemo').attr('href', demoUrl);
    }

    $('.configuratorDemo').on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        href = href.replace('https://cdn.jsdelivr.net/npm/cookie-bar/', '');
        window.location.replace(href);
    });

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