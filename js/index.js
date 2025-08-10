

let visibleCount = 8;

function renderMovies(list) {
  const container = document.getElementById("movieList");
  container.innerHTML = "";
  list.slice(0, visibleCount).forEach((m) => {
    container.innerHTML += `
      <div class="movie-card">
        <div class="card-image-container">
          <img src="${m.poster_image_url}" alt="${m.title}" class="card-img-top" loading="lazy" />
          <div class="image-overlay">
            <div class="overlay-buttons d-flex">
              <a href="movie_details.php?movie_id=${m.movie_id}"><button class="overlay-btn"><i class="bi bi-play-circle-fill"></i></button></a>
              <button class="overlay-btn"><i class="bi bi-bookmark-plus-fill"></i></button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div><a href = "movie_details.php?movie_id=${m.movie_id}"><h3 class="card-title">${m.title}</h3></a></div>
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

// For billing toggle button
const billingToggle = document.getElementById("billingToggle");
if (billingToggle) {
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
}

