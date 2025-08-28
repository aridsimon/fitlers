<?php
/** adds text to display when a facet is empty **/
add_action( 'facetwp_scripts', function() { ?>
<script>
(function($) {
    $(function() {
        // Before FacetWP refreshes, remove existing messages to avoid duplicates
        FWP.hooks.addAction('facetwp/refresh', function() {
            $('.facetwp-facet .no-results-message').remove();
        });

        // After FacetWP loads (initial and after interactions), add messages for empty facets
        FWP.hooks.addAction('facetwp/loaded', function() {
            try {
                if (FWP && FWP.settings && FWP.settings.num_choices) {
                    $.each(FWP.settings.num_choices, function(name, count) {
                        var $facet = $('.facetwp-facet-' + name);
                        $facet.find('.no-results-message').remove();
                        var hasChoices = parseInt(count, 10) > 0;
                        if (!hasChoices) {
                            $facet.append("<p class='no-results-message' aria-live='polite'>Nothing found matching the selected criteria.</p>");
                        }
                    });
                }
                else {
                    // Fallback: check for facets that render with no inner HTML
                    $('.facetwp-facet').each(function() {
                        var $facet = $(this);
                        var content = $.trim($facet.html());
                        $facet.find('.no-results-message').remove();
                        if ('' === content) {
                            $facet.append("<p class='no-results-message' aria-live='polite'>Nothing found matching the selected criteria.</p>");
                        }
                    });
                }
            }
            catch (e) {
                // No-op: avoid interrupting filtering UX
            }
        }, 1000 );
    });
})((typeof jQuery !== 'undefined') ? jQuery : fUtil);
</script>
<?php }, 100 );


?>
