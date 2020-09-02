$(document).ready(function () {
    let $sales = $('#sales');

    if (!$sales.length) {
        return;
    }

    const locale = $('html').attr('lang');
    const numberFormatCurrency = new Intl.NumberFormat(locale, {style: 'currency', currency: 'EUR'});

    const dateCol = 1;
    const dateUnixCol = 2;
    const priceCol = 7;

    $sales.DataTable({
        responsive: true,
        "footerCallback": function () {
            let api = this.api(),
                sum = api.column(priceCol, {page: 'current'}).data()
                    .reduce(function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);
            $(api.column(priceCol).footer()).find('span').text(numberFormatCurrency.format(sum));
        },
        "columnDefs": [
            {
                "targets": dateCol,
                "orderData": dateUnixCol
            },
            {
                "targets": dateUnixCol,
                "visible": false,
                "searchable": false
            },
            {
                "targets": priceCol,
                "render": function (value) {
                    return numberFormatCurrency.format(value);
                }
            }
        ],
        "language": {
            "sEmptyTable": "Keine Daten in der Tabelle vorhanden",
            "sInfo": "_START_ bis _END_ von _TOTAL_ Einträgen",
            "sInfoEmpty": "Keine Daten vorhanden",
            "sInfoFiltered": "(gefiltert von _MAX_ Einträgen)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ Einträge anzeigen",
            "sLoadingRecords": "Wird geladen ..",
            "sProcessing": "Bitte warten ..",
            "sSearch": "Suchen",
            "sZeroRecords": "Keine Einträge vorhanden",
            "oPaginate": {
                "sFirst": "Erste",
                "sPrevious": "Zurück",
                "sNext": "Nächste",
                "sLast": "Letzte"
            },
            "oAria": {
                "sSortAscending": ": aktivieren, um Spalte aufsteigend zu sortieren",
                "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
            },
            "select": {
                "rows": {
                    "_": "%d Zeilen ausgewählt",
                    "0": "",
                    "1": "1 Zeile ausgewählt"
                }
            },
            "buttons": {
                "print": "Drucken",
                "colvis": "Spalten",
                "copy": "Kopieren",
                "copyTitle": "In Zwischenablage kopieren",
                "copyKeys": "Taste <i>ctrl</i> oder <i>\u2318</i> + <i>C</i> um Tabelle<br>in Zwischenspeicher zu kopieren.<br><br>Um abzubrechen die Nachricht anklicken oder Escape drücken.",
                "copySuccess": {
                    "_": "%d Zeilen kopiert",
                    "1": "1 Zeile kopiert"
                },
                "pageLength": {
                    "-1": "Zeige alle Zeilen",
                    "_": "Zeige %d Zeilen"
                }
            }
        }
    });
});
