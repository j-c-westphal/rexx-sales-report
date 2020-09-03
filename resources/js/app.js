// Intl
if (!global.Intl) {
    require('intl');
    require('intl/locale-data/jsonp/en.js');
    require('intl/locale-data/jsonp/de.js');
}

// jQuery
window.$ = window.jQuery = require('jquery');

// Bootstrap
import 'bootstrap';

// Data Tables
// Init first
import 'datatables.net';
import 'datatables.net-bs4';
import 'datatables.net-responsive';
import 'datatables.net-responsive-bs4';
require('./datatables');

// Datepicker
// Init after init.dt event
// Remove loading spinner after 100ms
import 'bootstrap-datepicker';
require('./datepicker');
