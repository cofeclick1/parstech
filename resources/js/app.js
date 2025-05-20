import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// --- شروع کد Vue 3 و FormKit ---
import { createApp } from 'vue';
import { plugin as FormKitPlugin, defaultConfig } from '@formkit/vue';

// اگر قبلا المنت با این id داشتی، Vue رو mount کن
if (document.getElementById('dynamic-service-form')) {
    const app = createApp({});
    app.use(FormKitPlugin, defaultConfig);
    app.mount('#dynamic-service-form');
}
