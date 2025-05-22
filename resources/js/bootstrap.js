import axios from "axios";
window.axios = axios;

import("@popperjs/core");
import "../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js";
import "../../vendor/aliqasemzadeh/livewire-bootstrap-modal/resources/js/modals.js";

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
