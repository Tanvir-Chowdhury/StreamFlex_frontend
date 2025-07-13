//For Movies
// const movies = [
//   {
//     title: "Avatar",
//     year: 2009,
//     rating: 8.7,
//     genre: "Action",
//     lang: "English",
//     views: 9850,
//     duration: "2h 42m",
//     price: "50 Tk",
//     image: "images/avatar.jpg",
//   },
//   {
//     title: "Black Phone 2",
//     year: 2023,
//     rating: 7.8,
//     genre: "Drama",
//     lang: "English",
//     views: 7430,
//     duration: "1h 43m",
//     price: "30 Tk",
//     image: "images/blackphones2.jpg",
//   },
//   {
//     title: "Bullet Train",
//     year: 2022,
//     rating: 8.2,
//     genre: "Thriller",
//     lang: "English",
//     views: 8120,
//     duration: "2h 7m",
//     price: "50 Tk",
//     image: "images/bulletTrain.jpg",
//   },
//   {
//     title: "Civil War",
//     year: 2024,
//     rating: 7.6,
//     genre: "Adventure",
//     lang: "English",
//     views: 6400,
//     duration: "2h 5m",
//     price: "40 Tk",
//     image: "images/civilwar.jpg",
//   },
//   {
//     title: "The Kings Man",
//     year: 2021,
//     rating: 8.1,
//     genre: "Romance",
//     lang: "English",
//     views: 7090,
//     duration: "2h 11m",
//     price: "20 Tk",
//     image: "images/kingsman.jpg",
//   },
//   {
//     title: "Matrix",
//     year: 1999,
//     rating: 8.9,
//     genre: "Crime",
//     lang: "English",
//     views: 11200,
//     duration: "2h 30m",
//     price: "50 Tk",
//     image: "images/matrix.jpg",
//   },
//   {
//     title: "Titanic",
//     year: 1997,
//     rating: 9.1,
//     genre: "Sci-Fi",
//     lang: "English",
//     views: 12450,
//     duration: "3h 15m",
//     price: "55 Tk",
//     image: "images/titanic.jpg",
//   },
//   {
//     title: "Titanic",
//     year: 1997,
//     rating: 9.1,
//     genre: "Sci-Fi",
//     lang: "English",
//     views: 12450,
//     duration: "3h 15m",
//     price: "55 Tk",
//     image: "images/titanic.jpg",
//   },
//   {
//     title: "Titanic",
//     year: 1997,
//     rating: 9.1,
//     genre: "Sci-Fi",
//     lang: "English",
//     views: 12450,
//     duration: "3h 15m",
//     price: "55 Tk",
//     image: "images/titanic.jpg",
//   },
//   {
//     title: "Titanic",
//     year: 1997,
//     rating: 9.1,
//     genre: "Sci-Fi",
//     lang: "English",
//     views: 12450,
//     duration: "3h 15m",
//     price: "55 Tk",
//     image: "images/titanic.jpg",
//   },
//   {
//     title: "Titanic",
//     year: 1997,
//     rating: 9.1,
//     genre: "Sci-Fi",
//     lang: "English",
//     views: 12450,
//     duration: "3h 15m",
//     price: "55 Tk",
//     image: "images/titanic.jpg",
//   },
//   {
//     title: "Titanic",
//     year: 1997,
//     rating: 9.1,
//     genre: "Sci-Fi",
//     lang: "English",
//     views: 12450,
//     duration: "3h 15m",
//     price: "55 Tk",
//     image: "images/titanic.jpg",
//   },
// ];

let visibleCount = 8;

function renderMovies(list) {
  const container = document.getElementById("movieList");
  container.innerHTML = "";
  list.slice(0, visibleCount).forEach((m) => {
    container.innerHTML += `
      <div class="movie-card">
        <div class="card-image-container">
          <img src="${m.poster_image_url}" alt="${m.title}" class="card-img-top" />
          <div class="image-overlay">
            <div class="overlay-buttons d-flex">
              <a href="movie_details.php?movie_id=${m.movie_id}"><button class="overlay-btn"><i class="bi bi-play-circle-fill"></i></button></a>
              <button class="overlay-btn"><i class="bi bi-bookmark-plus-fill"></i></button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div><a href = "#" ><h3 class="card-title">${m.title}</h3></a></div>
          <div style="height: 100%;">
            <div class="card-meta">
              <span>${m.genre}</span>
              <span class="rating"><i class="bi bi-star-fill"></i>${m.rating}</span>
            </div>
            <div class="card-meta">
              <span><i class="bi bi-calendar"></i>${m.release_year}</span>
              <span style="color: var(--brand-purple)" class="price">${m.price} Tk</span>
            </div>
          </div>
        </div>
      </div>`;
  });
}

function loadMore() {
  visibleCount += 4;
  renderMovies(movies);
}

window.onload = () => renderMovies(movies);

//For billing toggle button
const billingToggle = document.getElementById("billingToggle");
billingToggle.addEventListener("click", () => {
  const price_basic = document.getElementById("price-basic");
  const price_standard = document.getElementById("price-standard");
  const price_premium = document.getElementById("price-premium");
  const priceText = document.querySelectorAll(".price-text");
  if (billingToggle.checked) {
    price_basic.innerHTML = "2680 Tk";
    price_standard.innerHTML = "3200 Tk";
    price_premium.innerHTML = "4800 Tk";

    priceText.forEach((e) => {
      e.innerHTML = "/year";
    });
  } else {
    price_basic.innerHTML = "280 Tk";
    price_standard.innerHTML = "340 Tk";
    price_premium.innerHTML = "510 Tk";

    priceText.forEach((e) => {
      e.innerHTML = "/month";
    });
  }
});
