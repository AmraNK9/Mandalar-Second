$(document).ready(function() {
    $("#search").on("click", function(event) {
        event.preventDefault(); // Prevent default form submission

        var searchValue = $("#search-box").val()
        console.log(searchValue);
        // Get the current URL
        var currentURL = window.location.href;

        // Check if the current URL is search.php
        if (!currentURL.includes('search.php')) {
            // If the current location is not search.php, redirect to search.php with the search value
            window.location.href = "search.php?searchinput=" + encodeURIComponent(searchValue);
            // searchValue = searchValue.replace(/\s/g, '')
            $.ajax({
        // Remove spaces from the search value

                type: "POST",
                url: "search.php",
                data: { searchinput: searchValue },
                success: function(response) {
                    // Handle the response data here if needed
                    console.log(response);
                   
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        if (currentURL.includes('search.php')) {
            // If the current location is not search.php, redirect to search.php with the search value
            window.location.href = "search.php?searchinput=" + encodeURIComponent(searchValue);
            // searchValue = searchValue.replace(/\s/g, '');
            $.ajax({
         // Remove spaces from the search value

                type: "POST",
                url: "search.php",
                data: { searchinput: searchValue },
                success: function(response) {
                    // Handle the response data here if needed
                    console.log(response);
                   
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
});