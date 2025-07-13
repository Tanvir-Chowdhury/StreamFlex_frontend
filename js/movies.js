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
              <a href = "movie_details.php?movie_id=${m.movie_id}"><button class="overlay-btn"><i class="bi bi-play-circle-fill"></i></button></a>
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

function applyFilters() {
  const genre = document.getElementById("genreFilter").value;
  const rating = parseFloat(document.getElementById("ratingFilter").value) || 0;
  const year = document.getElementById("yearFilter").value;
  const lang = document.getElementById("langFilter").value;
  const search = document.getElementById("searchInput").value.toLowerCase();
  const sort = document.getElementById("sortSelect").value;

  let filtered = movies.filter(
    (m) =>
      (!genre || m.genre === genre) &&
      (!year || m.release_year == year) &&
      (!lang || m.language === lang) &&
      (!rating || m.rating >= parseFloat(rating)) &&
      (!search || m.title.toLowerCase().includes(search))
  );

  if (sort === "newest") filtered.sort((a, b) => b.year - a.year);
  else if (sort === "alphabetical")
    filtered.sort((a, b) => a.title.localeCompare(b.title));

  visibleCount = 8;
  renderMovies(filtered);
}

function loadMore() {
  visibleCount += 4;
  applyFilters();
}

window.onload = () => applyFilters();


document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const suggestionsContainer = document.getElementById('suggestionsContainer2');

    searchInput.addEventListener('keyup', () => {
        const name = searchInput.value.trim();

        if (name === '') {
            suggestionsContainer.innerHTML = '';
            return;
        }

        fetch('suggestion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'suggestion=' + encodeURIComponent(name)
        })
        .then(response => response.text())
        .then(data => {
           suggestionsContainer.innerHTML = data;
        })
        .catch(error => {
            console.error('Error fetching suggestions:', error);
        });
    });
});
