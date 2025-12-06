/**
 * articlelist.js
 * Handles live search filtering for the blog article list.
 */

$(document).ready(function () {
    const $searchInput = $('#searchInput');
    const $postsContainer = $('#postsContainer');
    const $postCards = $('.post-card');
    const $noResults = $('#noResults');

    // Trigger search on input
    $searchInput.on('input', function () {
        const query = $(this).val().trim().toLowerCase();
        let visible = 0;

        $postCards.each(function () {
            const $card = $(this);
            const title = $card.data('title') || '';
            const excerpt = $card.data('excerpt') || '';

            if (title.includes(query) || excerpt.includes(query)) {
                $card.closest('.col-md-4').removeClass('d-none');
                visible++;
            } else {
                $card.closest('.col-md-4').addClass('d-none');
            }
        });

        // Toggle no-results message
        $noResults.toggleClass('d-none', visible > 0);
    });
});