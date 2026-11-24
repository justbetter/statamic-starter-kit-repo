import Alpine from 'alpinejs';
import AsyncAlpine from 'async-alpine';

Alpine.plugin(AsyncAlpine);

Alpine.asyncData('formSubmit', () => import('./components/formSubmit.js'));
Alpine.asyncData('video', () => import('./components/video.js'));

window.Alpine = Alpine;
Alpine.start();
