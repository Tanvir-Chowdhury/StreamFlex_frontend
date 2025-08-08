// movies.js (Universal, robust, and modular)

(function () {
  // Only run if window.movies is available
  if (!window.movies || !Array.isArray(window.movies)) {
    // Optionally, you can log or silently do nothing
    // console.log("No movies data found on this page.");
    return;
  }

  let visibleCount = 8;

  // Render movies to the UI
  function renderMovies(list) {
    const container = document.getElementById("movieList");
    if (!container) return;
    container.innerHTML = "";
    list.slice(0, visibleCount).forEach((m) => {
      container.innerHTML += `
        <div class="movie-card">
          <div class="card-image-container">
            <img src="${m.poster_image_url}" alt="${m.title}" class="card-img-top" loading="lazy"/>
            <div class="image-overlay">
              <div class="overlay-buttons d-flex">
                <a href="movie_details.php?movie_id=${m.movie_id}"><button class="overlay-btn"><i class="bi bi-play-circle-fill"></i></button></a>
                <button class="overlay-btn"><i class="bi bi-bookmark-plus-fill"></i></button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div><a href="movie_details.php?movie_id=${m.movie_id}"><h3 class="card-title">${m.title}</h3></a></div>
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
        </div>
      `;
    });
  }

  // Apply filters and sorting
  function applyFilters() {
    // Get filter values safely
    const genre = document.getElementById("genreFilter")?.value || "";
    const rating = parseFloat(document.getElementById("ratingFilter")?.value) || 0;
    const year = document.getElementById("yearFilter")?.value || "";
    const lang = document.getElementById("langFilter")?.value || "";
    const search = document.getElementById("searchInput")?.value.toLowerCase() || "";
    const sort = document.getElementById("sortSelect")?.value || "";

    let filtered = window.movies.filter(
      (m) =>
        (!genre || m.genre === genre) &&
        (!year || m.release_year == year) &&
        (!lang || m.language === lang) &&
        (!rating || m.rating >= parseFloat(rating)) &&
        (!search || m.title.toLowerCase().includes(search))
    );

    // Sorting
    if (sort === "newest") filtered.sort((a, b) => b.release_year - a.release_year);
    else if (sort === "alphabetical")
      filtered.sort((a, b) => a.title.localeCompare(b.title));

    visibleCount = 8;
    renderMovies(filtered);
  }

  // Load more movies
  window.loadMore = function () {
    visibleCount += 4;
    applyFilters();
  };

  // Setup event listeners and initial render
  window.addEventListener('DOMContentLoaded', () => {
    // Render with any filters applied
    applyFilters();

    // Optional: Add filter/search/sort event listeners for better UX
    document.getElementById("searchInput")?.addEventListener("input", applyFilters);
    document.getElementById("genreFilter")?.addEventListener("change", applyFilters);
    document.getElementById("ratingFilter")?.addEventListener("change", applyFilters);
    document.getElementById("yearFilter")?.addEventListener("change", applyFilters);
    document.getElementById("langFilter")?.addEventListener("change", applyFilters);
    document.getElementById("sortSelect")?.addEventListener("change", applyFilters);

    // AJAX-powered suggestions (if present)
    const searchInput = document.getElementById('searchInput');
    const suggestionsContainer = document.getElementById('suggestionsContainer2');
    if (searchInput && suggestionsContainer) {
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
    }
  });

  // Expose applyFilters for manual calls (e.g., from button onclick)
  window.applyFilters = applyFilters;

})();
