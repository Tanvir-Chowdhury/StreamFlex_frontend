document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('search');
  const suggestionsContainer = document.getElementById('suggestionsContainer');

  searchInput.addEventListener('keyup', (e) => {
    const name = searchInput.value.trim();

    if (e.key === 'Enter') {
      const firstSuggestion = suggestionsContainer.querySelector('.suggestion-item');
      if (firstSuggestion) {
        const movieId = firstSuggestion.getAttribute('movie_id');
        window.location.href = `movie_details.php?movie_id=${movieId}`;
      }
      return;
    }

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

      const items = suggestionsContainer.querySelectorAll('.suggestion-item');
      items.forEach(item => {
        item.addEventListener('click', () => {
          const movieId = item.getAttribute('movie_id');
          window.location.href = `movie_details.php?movie_id=${movieId}`;
        });
      });
    })
    .catch(error => {
      console.error('Error fetching suggestions:', error);
    });
  });
});


  