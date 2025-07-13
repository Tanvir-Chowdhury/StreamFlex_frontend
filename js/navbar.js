document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search');
    const suggestionsContainer = document.getElementById('suggestionsContainer');

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
