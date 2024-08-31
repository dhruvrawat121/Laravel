$(document).ready(function() {
    let selectedIndex = -1;
    let debounceTimerId;
    /**
     * Append the Result data to the document
     * @param {Array} results 
     */
    function updateResults(results) {
        const resultsContainer = $('#search-results');
        resultsContainer.empty();

        if (results.length > 0) {
            results.forEach((item, index) => {
                resultsContainer.append(`<li data-index="${index}">${highlightText(item.name, $('#search').val())}</li>`);
            });
            resultsContainer.show();
        } else {
            resultsContainer.append('<li>No Results Found</li>');
            resultsContainer.show();
        }
    }
    /**
     * 
     * @param {string} text 
     * @param {string} query 
     * @returns Hightlights the matching text
     */
    function highlightText(text, query) {
        const regex = new RegExp(`(${query})`, 'ig');
        return text.replace(regex, '<strong>$1</strong>');
    }
    /**
     * 
     * @param {event} e 
     * @returns Handles the Key navigation
     */
    function handleKeyNavigation(e) {
        const items = $('#search-results li');
        if (items.length === 0) return;

        if (e.key === 'ArrowDown') {
            selectedIndex = (selectedIndex + 1) % items.length;
        } else if (e.key === 'ArrowUp') {
            selectedIndex = (selectedIndex - 1 + items.length) % items.length;
        } else if (e.key === 'Enter') {
            if (selectedIndex >= 0 && selectedIndex < items.length) {
                $(items[selectedIndex]).click();
                return;
            }
        }

        items.removeClass('selected');
        if (selectedIndex >= 0 && selectedIndex < items.length) {
            $(items[selectedIndex]).addClass('selected');
            $('#search').val($(items[selectedIndex]).text());
        }
    }

    $('#search').on('keyup', function(e) {
        clearTimeout(debounceTimerId);
        var query = $(this).val();

        if (query.length > 2) {
            $('#loader').show();
            // Sends the network reqeuest with the query parameter
            debounceTimerId = setTimeout(function() {
                $.ajax({
                    url: '/search/results',
                    type: 'GET',
                    data: { query: query },
                    success: function(data) {
                        updateResults(data);
                        $('#loader').hide(); 
                    },
                    error: function() {
                        $('#search-results').empty().append('<li>Error fetching results</li>').show();
                        $('#loader').hide(); 
                    }
                });
            }, 300);
        } else {
            $('#search-results').empty().hide();
            $('#loader').hide();
        }
        
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp' || e.key === 'Enter') {
            e.preventDefault(); // Prevent default action to avoid updating input
            handleKeyNavigation(e);
        } else {
            selectedIndex = -1; // Reset selection if typing
        }
    });

    $('#search-results').on('click', 'li', function() {
        $('#search').val($(this).text());
        $('#search-results').empty().hide();
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search, #search-results').length) {
            $('#search-results').empty().hide();
        }
    });
});
