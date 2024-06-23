import './bootstrap';
import Alpine from 'alpinejs'
import Intersect from '@alpinejs/intersect'
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

Alpine.plugin(Intersect)

window.notyf = new Notyf({
    duration: 2000,
    position: {
        x: 'center',
        y: 'top',
    },
    types: [
        {
            type: 'success',
            background: '#1F2937',
            icon: {
                className: 'fa-solid fa-circle-check',
                tagName: 'i',
                color: '#f0bc74',
            },
        },
    ],
});

window.Alpine = Alpine;

Alpine.start()
