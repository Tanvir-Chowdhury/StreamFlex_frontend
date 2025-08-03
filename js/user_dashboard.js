document.addEventListener("DOMContentLoaded", function () {
  const history = [
    {
      title: "Avatar",
      image: "images/avatar.jpg",
      genre: "Action",
      rating: "8.7",
      duration: "2h 42m",
      price: "50 Tk",
    },
    {
      title: "Black Phone 2",
      image: "images/blackphones2.jpg",
      genre: "Drama",
      rating: "7.8",
      duration: "1h 43m",
      price: "30 Tk",
    }
  ];

  const container = document.getElementById("watchHistory");
  container.innerHTML = history.map(movie => `
    <div class="movie-card">
      <div class="card-image-container">
        <img src="${movie.image}" class="card-img-top" alt="${movie.title}" loading="lazy"/>
      </div>
      <div class="card-body p-3">
        <h4 class="card-title">${movie.title}</h4>
        <div class="card-meta d-flex justify-content-between text-muted">
          <span>${movie.genre}</span>
          <span><i class="bi bi-star-fill"></i> ${movie.rating}</span>
        </div>
        <div class="card-meta d-flex justify-content-between text-muted">
          <span><i class="bi bi-clock"></i> ${movie.duration}</span>
          <span style="color: var(--brand-purple)" class="price">${movie.price}</span>
        </div>
      </div>
    </div>
  `).join("");
});