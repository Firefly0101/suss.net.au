
// setup globals
var $loggedin = false;

// get     
function show_events(type){
    console.log('show my events: ' + type);
    var $tickets = jQuery('.article-wrapper .has_ticket');
    console.log($tickets.length);
    if (type == true) { // show my events
        jQuery('.no_ticket').fadeOut();
        jQuery('#has_tickets').removeClass('is-style-outline');
        jQuery('#all_tickets').addClass('is-style-outline');
        
        // show error is needed
        if ($tickets.length == 0) {
            jQuery('#user-message').fadeIn();
        } 

    } else if (type == false){
        jQuery('.no_ticket').fadeIn();
        
        jQuery('#all_tickets').removeClass('is-style-outline');
        jQuery('#has_tickets').addClass('is-style-outline');

        jQuery('#user-message').fadeOut();
    }
    checkIsLoggedIn($loggedin);
    
}

function checkIsLoggedIn(user) {
    if (user == true){
        jQuery('#user-message .loggedin').show();
        jQuery('#user-message .loggedout').hide();
        
    } else {
        jQuery('#user-message .loggedout').show();
        jQuery('#user-message .loggedin').hide();
    }
}

function toggleChat() {
    jQuery('.chat-wrapper').toggle();
    jQuery('.chat-show').toggle();
    jQuery('.chat-hide').toggle();
}

jQuery(function() {
    var hash = window.location.hash;
    if (hash.length > 0 && hash == '#myevents') {
        console.log( "ready! " + hash);
        show_events(true);
    }

    $loggedin = jQuery('BODY').hasClass('logged-in');
    //console.log($loggedin);
    jQuery('.chat-show').toggle();

    
 });

