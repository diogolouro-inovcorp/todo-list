// Este será o service worker personalizado com suporte a notificações push

self.addEventListener('push', function (event) {
    const data = event.data?.json() ?? {};

    const title = data.title ?? 'Nova Notificação';
    const options = {
        body: data.body ?? '',
        icon: '/pwa-192x192.png',
        badge: '/pwa-192x192.png',
        data: {
            url: data.url ?? '/',
        },
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
