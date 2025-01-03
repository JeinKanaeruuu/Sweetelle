import './bootstrap';
import 'flowbite';
import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';

const swiper = new Swiper('.swiper-container', {
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});