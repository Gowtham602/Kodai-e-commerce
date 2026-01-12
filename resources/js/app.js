import './bootstrap';
import * as bootstrap from 'bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;
console.log(window.$,"_____")

import 'jquery-validation';
window.bootstrap = bootstrap;
// admin modules
import { initProductValidation } from './admin/product-form';
// run after everything loaded
document.addEventListener('DOMContentLoaded', () => {
    initProductValidation();
});

import './loginheader';
import './homepage';
import './nav';
import './cart';
import './addcart';
import  './admin';

import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js'; // optional, for JS features

import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
