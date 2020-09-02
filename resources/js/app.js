// Bootstrap
require('./bootstrap');

// Intl
if (!global.Intl) {
    require('intl');
    require('intl/locale-data/jsonp/en.js');
    require('intl/locale-data/jsonp/de.js');
}

// Data Tables
import 'jquery';
import 'datatables.net';
import 'datatables.net-bs4';
import 'datatables.net-responsive';
import 'datatables.net-responsive-bs4';
require('./datatables');
