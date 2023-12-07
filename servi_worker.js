const CACHE_NAME = 'mi-cache';

const archivosParaCache = [
    'index.html',
    'estilo.css',
    'todo.js',
    'manifest.json' 
];

// Evento de instalación del Service Worker
self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        // Almacena los archivos en caché
        return cache.addAll(archivosParaCache);
      })
  );
});

// Evento de activación del Service Worker
self.addEventListener('activate', function(event) {
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cache) {
          if (cache !== CACHE_NAME) {
            // Borra las cachés antiguas si existen
            return caches.delete(cache);
          }
        })
      );
    })
  );
});

// Evento Fetch para interceptar las solicitudes de red
self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Si se encuentra en caché, devuelve la respuesta en caché
        if (response) {
          return response;
        }
        // Si no se encuentra en caché, realiza la solicitud a la red y almacena en caché la respuesta
        return fetch(event.request).then(function(response) {
          // Comprueba si la respuesta es válida antes de almacenarla en caché
          if (!response || response.status !== 200 || response.type !== 'basic') {
            return response;
          }
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then(function(cache) {
            cache.post(event.request, responseToCache);
          });
          return response;
        });
      })
  );
});
