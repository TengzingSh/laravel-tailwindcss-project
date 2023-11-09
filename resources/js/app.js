import './bootstrap';

import Alpine from 'alpinejs';

import * as Sentry from "@sentry/browser";

window.Alpine = Alpine;

Alpine.start();

Sentry.init({
  dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
});


