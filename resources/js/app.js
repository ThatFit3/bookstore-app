import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Initialization for ES Users
import {
    Modal,
    Ripple,
    initTWE,
} from "tw-elements";

initTWE({ Modal, Ripple });