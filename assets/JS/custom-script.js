jQuery(document).ready(function ($) {
    var paged = 1; // Start from page 1

    // Initial load
    loadEvents(paged);

    $('#prev-btn, #next-btn').on('click', function (e) {
        e.preventDefault();
        var direction = $(this).data('direction');

        if (direction === 'prev' && paged > 1) {
            paged--;
        } else if (direction === 'next') {
            paged++;
        }

        loadEvents(paged);
    });

    function loadEvents(paged) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'load_events',
                paged: paged
            },
            success: function (response) {
                $('#events-container').html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
