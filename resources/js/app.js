import './bootstrap';

// import './axiosConfig.js';

import { createApp } from "vue/dist/vue.esm-bundler";

import axios from 'axios';
import LoginForm from './components/LoginForm.vue';
import RegisterForm from './components/RegisterForm.vue';
import Logout from './components/Logout.vue';
import ProfileEdit from './components/ProfileEdit.vue';
import CardComponent from './components/CardComponent.vue';
import SettingsComponent from './components/SettingsComponent.vue';

// Global Axios configuration
// axios.defaults.baseURL = '/api';
axios.defaults.headers.common['Content-Type'] = 'application/json';

const app = createApp({});

app.component('LoginForm', LoginForm);
app.component('RegisterForm', RegisterForm);
app.component('Logout', Logout);
app.component('ProfileEdit', ProfileEdit);
app.component('CardComponent', CardComponent);
app.component('SettingsComponent', SettingsComponent);

app.mount('#app');


