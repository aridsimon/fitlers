<?php
/** adds text to display when a facet is empty **/
add_action( 'facetwp_scripts', function() { ?>
<script>
(function($) {
    $(function() {
        FWP.hooks.addAction('facetwp/loaded', function() {
            $('.facetwp-facet').each(function() {
                var content = $(this).html();
                if ('' == content) {
                    $(this).append("<p class='no-results-message' style='color: #fff;''>Nothing found matching the selected criteria.</p>");
                }				
            });
        }, 1000 );
    });
})(fUtil);
</script>
<?php }, 100 );
