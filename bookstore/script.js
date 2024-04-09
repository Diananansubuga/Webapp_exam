document.addEventListener("DOMContentLoaded", function() {
  var searchInput = document.getElementById('searchForm');
  var searchResults = document.getElementById('searchResults');

  searchInput.addEventListener('input', function() {
      var query = this.value.trim(); // Trim whitespace from the input

      if (query !== '') {
          searchBooks(query);
      } else {
          searchResults.innerHTML = ''; // Clear the search results if the input is empty
      }
  });
});

function searchBooks(query) {
  fetch('search.php?searchF=' + query)
    .then(response => response.text())
    .then(data => {
      searchResults.innerHTML = data;
    });
}





document.getElementById("recommendationForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent default form submission

  // Get genre input value
  var genre = document.getElementById("genre").value.trim();

  // Clear previous recommendations
  document.getElementById("recommendations").innerHTML = "";

  // Fetch recommendations based on genre
  fetchRecommendations(genre);
});

function fetchRecommendations(genre) {
  // Send AJAX request to PHP backend
  fetch("recomendations.php?genre=" + encodeURIComponent(genre))
      .then(response => response.text())
      .then(data => {
          // Display recommendations
          document.getElementById("recommendations").innerHTML = data;
      })
      .catch(error => console.error("Error fetching recommendations:", error));
}
