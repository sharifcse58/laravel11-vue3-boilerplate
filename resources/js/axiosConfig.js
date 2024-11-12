
import axios from 'axios';

// Set up Axios defaults
// axios.defaults.baseURL = '/api';
// axios.defaults.timeout = 10000;
// axios.defaults.headers.common['Content-Type'] = 'application/json';

// // Get the CSRF token from the meta tag
// const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.content;

// // Set the CSRF token in the Axios default headers
// if (csrfToken) {
//     axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
// }

// Ensure CSRF token and cookies are sent with requests
//axios.defaults.withCredentials = true;  // Send cookies with each request


export function setAuthToken(token) {
    if (token) {
        localStorage.setItem('token', token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    } else {
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
    }
}

export default axios;
