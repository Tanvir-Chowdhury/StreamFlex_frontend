const CACHE_NAME = "streamflex-v1";
const URLS_TO_CACHE = [
  "/index.php",
  "/movies.php",
  "/css/brand.css",
  "/css/navbar.css",
  "/css/style.css",
  "/css/index.css",
  "/js/movies.js",
  "/js/navbar.js",
  "/js/index.js",
  "/images/movie-series-list.jpg"
];

self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(URLS_TO_CACHE);
    })
  );
});

self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.filter(key => key !== CACHE_NAME).map(key => caches.delete(key))
      )
    )
  );
});

self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(cached => {
      return cached || fetch(event.request);
    })
  );
});
