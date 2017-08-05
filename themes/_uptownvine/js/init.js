jQuery(document).ready(function() {
    jQuery(".arpw-li").hover(
        function() {
            jQuery(this).find(".arpw-text-container").slideDown("fast");
    },
        function() {
            jQuery(this).find(".arpw-text-container").slideUp("fast" );
        }
    );
    jQuery(".inactive-link").click(function(e) {
        e.preventDefault();
    });
    jQuery(".read-more").mouseover(function() {
        jQuery(this).css({
            borderColor: "white",
            color: "white"
        }, 1500);
    });
    jQuery(".read-more").mouseout(function() {
        jQuery(this).css({
            borderColor: "#66CCCC",
            color: "#66CCCC"
        }, 1500);
    });
});

