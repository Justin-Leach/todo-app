import './bootstrap';

import Alpine from 'alpinejs';
import Pikaday from 'pikaday';
import moment from 'moment';

window.Alpine = Alpine;
window.Sortable = require('sortablejs').default;
window.Pikaday = Pikaday;
window.moment = moment;

Alpine.start();
