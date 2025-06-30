const form = document.getElementById("movieForm");
      const tableBody = document.getElementById("movieTableBody");
      let movies = [
        {
          id: 1,
          imdb: "https://www.imdb.com/title/tt0499549/",
          video: "https://www.youtube.com/embed/5PSNL1qE6VY",
          trailer: "https://www.youtube.com/watch?v=5PSNL1qE6VY",
          language: "English",
          genre: "Action",
          details: "A paraplegic Marine dispatched to the moon Pandora...",
        },
      ];

      form.addEventListener("submit", function (e) {
        e.preventDefault();

        const movie = {
          id: Date.now(),
          imdb: document.getElementById("imdb").value,
          video: document.getElementById("video").value,
          trailer: document.getElementById("trailer").value,
          details: document.getElementById("details").value,
          language: document.getElementById("language").value,
          genre: document.getElementById("genre").value,
        };

        movies.push(movie);
        form.reset();
        renderMovies();
      });

      function renderMovies() {
        tableBody.innerHTML = "";
        movies.forEach((m) => {
          tableBody.innerHTML += `
        <tr>
          <td><a href="${m.imdb}" target="_blank">IMDB</a></td>
          <td><a href="${m.video}" target="_blank">Video</a></td>
          <td><a href="${m.trailer}" target="_blank">Trailer</a></td>
          <td>${m.language}</td>
          <td>${m.genre}</td>
          <td>${m.details}</td>
          <td>
            <button class="btn btn-sm btn-warning me-2" onclick="editMovie(${m.id})"><i class="bi bi-pencil-fill"></i></button>
            <button class="btn btn-sm btn-danger" onclick="deleteMovie(${m.id})"><i class="bi bi-trash-fill"></i></button>
          </td>
        </tr>
      `;
        });
      }

      function deleteMovie(id) {
        if (confirm("Are you sure you want to delete this movie?")) {
          movies = movies.filter((m) => m.id !== id);
          renderMovies();
        }
      }

      function editMovie(id) {
        const movie = movies.find((m) => m.id === id);
        if (movie) {
          document.getElementById("imdb").value = movie.imdb;
          document.getElementById("video").value = movie.video;
          document.getElementById("trailer").value = movie.trailer;
          document.getElementById("details").value = movie.details;
          document.getElementById("language").value = movie.language;
          document.getElementById("genre").value = movie.genre;

          movies = movies.filter((m) => m.id !== id);
        }
      }

      renderMovies();