$.fn.datepicker.dates['de'] = {
    days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
    daysShort: ["Son", "Mon", "Die", "Mit", "Don", "Fre", "Sam"],
    daysMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
    monthsShort: ["Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
    today: "Heute",
    monthsTitle: "Monate",
    clear: "Löschen",
    weekStart: 1,
    format: "d. MM yyyy"
};

$.fn.datepicker.defaults.language = 'de';
$.fn.datepicker.defaults.autoclose = true;
$.fn.datepicker.defaults.container = '#report-wrap';

$(document).ready(function () {
    let $startDate = $('#startDate');
    let $endDate = $('#endDate');

    if (!$startDate.length || !$endDate.length) {
        return;
    }

    $startDate.datepicker();
    $endDate.datepicker();
});
