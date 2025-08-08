// Keys are now defined in the HTML by PHP, not in JS file

async function searchMovies() {
  const title = document.getElementById("searchTitle").value.trim();
  const year = document.getElementById("searchYear").value.trim();
  const resultsContainer = document.getElementById("searchResults");
  resultsContainer.innerHTML = "Searching...";

  const res = await fetch(`https://www.omdbapi.com/?apikey=${OMDB_API_KEY}&s=${encodeURIComponent(title)}&y=${year}`);
  const data = await res.json();

  if (data.Response === "False") {
    resultsContainer.innerHTML = `<p class="text-danger">${data.Error}</p>`;
    return;
  }

  resultsContainer.innerHTML = "<h5>Select a Movie:</h5>";
  data.Search.forEach(movie => {
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

async function selectMovie(imdbID) {
  const res = await fetch(`https://www.omdbapi.com/?apikey=${OMDB_API_KEY}&i=${imdbID}`);
  const movie = await res.json();

  if (movie.Response === "False") return alert("Failed to load movie details.");

  // Fill form
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
  document.getElementById("trailer_url").value = "https://www.youtube.com/embed/";

  // TMDB poster fetch
  const tmdbRes = await fetch(`https://api.themoviedb.org/3/search/movie?api_key=${TMDB_API_KEY}&query=${encodeURIComponent(movie.Title)}&year=${movie.Year}`);
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
