
	

// get     
function show_events(type){
    console.log('show my events: ' + type);
    var $tickets = jQuery('.article-wrapper .has_ticket');
    console.log($tickets);
    if (type == true) {
        jQuery('.no_ticket').fadeOut();
        jQuery('#has_tickets').removeClass('is-style-outline');
        jQuery('#all_tickets').addClass('is-style-outline');

    } else if (type == false){
        jQuery('.no_ticket').fadeIn();
        
        jQuery('#all_tickets').removeClass('is-style-outline');
        jQuery('#has_tickets').addClass('is-style-outline');

    }
}

jQuery(function() {
    var hash = window.location.hash;
    if (hash.length > 0 && hash == '#myevents') {
        console.log( "ready! " + hash);
        show_events(true);
    }

 });

