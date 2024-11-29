$(document).ready(function () {
    $('#searchQuery').on('keyup', function () {
        const query = $(this).val().trim();
        
        if (query === '') {
            $('#searchResults').html('<p>Please enter a search term.</p>');
            return;
        }
        
        $.ajax({
            url: '/ZNH ASSIGNMENT/includes/AJAX.php',
            method: 'GET',
            data: { query: query },
            beforeSend: function () {
                $('#searchResults').html('<p>Searching...</p>');
            },
            success: function (data) {
                $('#searchResults').html(data); // Display the search results
            },
            error: function () {
                $('#searchResults').html('<p>An error occurred while searching.</p>');
            }
        });
    });
});
