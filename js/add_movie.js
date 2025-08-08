// ---- Search Movies (OMDb) ----
async function searchMovies() {
  const title = document.getElementById("searchTitle").value.trim();
  const year = document.getElementById("searchYear").value.trim();
  const resultsContainer = document.getElementById("searchResults");
  resultsContainer.innerHTML = "Searching...";

  const res = await fetch(
    `https://www.omdbapi.com/?apikey=${OMDB_API_KEY}&s=${encodeURIComponent(title)}&y=${year}`
  );
  const data = await res.json();

  if (data.Response === "False") {
    resultsContainer.innerHTML = `<p class="text-danger">${data.Error}</p>`;
    return;
  }

  resultsContainer.innerHTML = "<h5>Select a Movie:</h5>";
  data.Search.forEach((movie) => {
    const div = document.createElement("div");
    div.className = "mb-2";
    div.innerHTML = `
      <button class="btn btn-outline-primary" onclick="selectMovie('${movie.imdbID}')">
        ${movie.Title} (${movie.Year}) — ${movie.imdbID}
      </button>
    `;
    resultsContainer.appendChild(div);
  });
}

// ---- Select Movie, Fill Form ----
async function selectMovie(imdbID) {
  const res = await fetch(
    `https://www.omdbapi.com/?apikey=${OMDB_API_KEY}&i=${imdbID}`
  );
  const movie = await res.json();

  if (movie.Response === "False") return alert("Failed to load movie details.");

  // Fill form fields
  document.getElementById("title").value = movie.Title || "";
  document.getElementById("genre").value = movie.Genre || "";
  document.getElementById("rating").value =
    movie.imdbRating !== "N/A" && !isNaN(parseFloat(movie.imdbRating))
      ? parseFloat(movie.imdbRating)
      : "";
  document.getElementById("language").value = movie.Language || "";
  document.getElementById("description").value = movie.Plot || "";
  document.getElementById("release_year").value = movie.Year || "";
  document.getElementById("imdb_url").value = `https://www.imdb.com/title/${imdbID}`;

  // ---- Fetch and set trailer (YouTube) ----
  const trailerUrl = await fetchYouTubeTrailer(movie.Title, movie.Year);
  document.getElementById("trailer_url").value = trailerUrl;
  showTrailerPreview(trailerUrl);

  // ---- TMDB poster fetch ----
  const tmdbRes = await fetch(
    `https://api.themoviedb.org/3/search/movie?api_key=${TMDB_API_KEY}&query=${encodeURIComponent(movie.Title)}&year=${movie.Year}`
  );
  const tmdbData = await tmdbRes.json();

  if (tmdbData.results && tmdbData.results.length > 0) {
    const first = tmdbData.results[0];
    const posterUrl = `https://image.tmdb.org/t/p/original${first.poster_path}`;
    document.getElementById("poster_image_url").value = posterUrl;
    document.getElementById("tmdb_url").value = `https://www.themoviedb.org/movie/${first.id}`;
  } else {
    alert("TMDB poster not found.");
  }

  document.getElementById("movieForm").scrollIntoView({ behavior: "smooth" });
}

// ---- Fetch Trailer From YouTube ----
async function fetchYouTubeTrailer(title, year) {
  const query = encodeURIComponent(`${title} ${year} trailer`);
  const url = `https://www.googleapis.com/youtube/v3/search?key=${YOUTUBE_API_KEY}&part=snippet&type=video&maxResults=1&q=${query}`;
  const response = await fetch(url);
  const data = await response.json();
  if (data.items && data.items.length > 0) {
    const videoId = data.items[0].id.videoId;
    return `https://www.youtube.com/embed/${videoId}`;
  } else {
    return "";
  }
}

// ---- Trailer Preview (for both fetched and manual input) ----
function showTrailerPreview(url) {
  const trailerDiv = document.getElementById("trailerPreview");
  if (!trailerDiv) return;
  if (url) {
    trailerDiv.innerHTML = `<iframe width="100%" height="280" src="${url}" frameborder="0" allowfullscreen></iframe>`;
  } else {
    trailerDiv.innerHTML = "";
  }
}

// ---- Manual Input: Auto-convert and Preview ----
document.getElementById("trailer_url").addEventListener("change", function() {
  let val = this.value.trim();
  const match = val.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w\-]+)/);
  if (match) {
    this.value = `https://www.youtube.com/embed/${match[1]}`;
    showTrailerPreview(this.value);
  } else if (val.includes("youtube.com/embed/")) {
    showTrailerPreview(val);
  } else {
    showTrailerPreview("");
  }
});

// ---- Search form submit (on Enter or button) ----
document.getElementById("searchForm").addEventListener("submit", function (e) {
  e.preventDefault();
  searchMovies();
});
