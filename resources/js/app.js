
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import canDirective from './directives/can'; // Import the directive

import '../admin_scripts/libs/apexcharts/dist/apexcharts.min.js?1684106062';
import '../admin_scripts/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062';
import '../admin_scripts/libs/jsvectormap/dist/maps/world.js?1684106062';
import '../admin_scripts/libs/jsvectormap/dist/maps/world-merc.js?1684106062';
import '../admin_scripts/js/tabler.min.js?1684106062';
import '../admin_scripts/js/demo.min.js?1684106062';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'; 

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.directive('can', canDirective);

        app
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});