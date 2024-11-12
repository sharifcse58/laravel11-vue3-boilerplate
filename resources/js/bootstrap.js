import axios from 'axios';
window.axios = axios;

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

// axios.defaults.baseURL = '/api';
// axios.defaults.timeout = 10000;
axios.defaults.headers.common['Content-Type'] = 'application/json';

// // Get the CSRF token from the meta tag
const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.content;

// Set the CSRF token in the Axios default headers
if (csrfToken) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
