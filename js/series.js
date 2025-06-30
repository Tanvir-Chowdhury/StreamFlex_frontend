const seriess = [
  {
    title: "Avatar",
    year: 2009,
    rating: 8.7,
    genre: "Action",
    lang: "English",
    views: 9850,
    duration: "2h 42m",
    price: "50 Tk",
    image: "images/avatar.jpg",
  },
  {
    title: "Black Phone 2",
    year: 2023,
    rating: 7.8,
    genre: "Drama",
    lang: "English",
    views: 7430,
    duration: "1h 43m",
    price: "30 Tk",
    image: "images/blackphones2.jpg",
  },
  {
    title: "Bullet Train",
    year: 2022,
    rating: 8.2,
    genre: "Thriller",
    lang: "English",
    views: 8120,
    duration: "2h 7m",
    price: "50 Tk",
    image: "images/bulletTrain.jpg",
  },
  {
    title: "Civil War",
    year: 2024,
    rating: 7.6,
    genre: "Adventure",
    lang: "English",
    views: 6400,
    duration: "2h 5m",
    price: "40 Tk",
    image: "images/civilwar.jpg",
  },
  {
    title: "The Kings Man",
    year: 2021,
    rating: 8.1,
    genre: "Romance",
    lang: "English",
    views: 7090,
    duration: "2h 11m",
    price: "20 Tk",
    image: "images/kingsman.jpg",
  },
  {
    title: "Matrix",
    year: 1999,
    rating: 8.9,
    genre: "Crime",
    lang: "English",
    views: 11200,
    duration: "2h 30m",
    price: "50 Tk",
    image: "images/matrix.jpg",
  },
  {
    title: "Titanic",
    year: 1997,
    rating: 9.1,
    genre: "Sci-Fi",
    lang: "English",
    views: 12450,
    duration: "3h 15m",
    price: "55 Tk",
    image: "images/titanic.jpg",
  },
];

let visibleCount = 10;

function renderseriess(list) {
  const container = document.getElementById("seriesList");
  container.innerHTML = "";
  list.slice(0, visibleCount).forEach((m) => {
    container.innerHTML += `
      <div class="series-card">
        <div class="card-image-container">
          <img src="${m.image}" alt="${m.title}" class="card-img-top" />
          <div class="image-overlay">
            <div class="overlay-buttons d-flex">
              <button class="overlay-btn"><i class="bi bi-play-circle-fill"></i></button>
              <button class="overlay-btn"><i class="bi bi-bookmark-plus-fill"></i></button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h3 class="card-title">${m.title}</h3>
          <div class="card-meta">
            <span>${m.genre}</span>
            <span class="rating"><i class="bi bi-star-fill"></i>${m.rating}</span>
          </div>
          <div class="card-meta">
            <span><i class="bi bi-clock"></i>${m.duration}</span>
            <span style="color: var(--brand-purple)" class="price">${m.price}</span>
          </div>
        </div>
      </div>`;
  });
}

function applyFilters() {
  const genre = document.getElementById("genreFilter").value;
  const rating = parseFloat(document.getElementById("ratingFilter").value) || 0;
  const year = document.getElementById("yearFilter").value;
  const lang = document.getElementById("langFilter").value;
  const search = document.getElementById("searchInput").value.toLowerCase();
  const sort = document.getElementById("sortSelect").value;

  let filtered = seriess.filter(
    (m) =>
      (!genre || m.genre === genre) &&
      (!year || m.year == year) &&
      (!lang || m.lang === lang) &&
      (!rating || m.rating >= rating) &&
      (!search || m.title.toLowerCase().includes(search))
  );

  if (sort === "mostViewed") filtered.sort((a, b) => b.views - a.views);
  else if (sort === "newest") filtered.sort((a, b) => b.year - a.year);
  else if (sort === "alphabetical")
    filtered.sort((a, b) => a.title.localeCompare(b.title));

  visibleCount = 10;
  renderseriess(filtered);
}

function loadMore() {
  visibleCount += 10;
  applyFilters();
}

window.onload = () => applyFilters();
