(function( $ ) {
	'use strict';

	$( '#nds_add_user_meta_ajax_form' ).submit( function( event ) {
            
        event.preventDefault();          
        
        // serialize the form data
        var ajax_form_data = $("#nds_add_user_meta_ajax_form").serialize();
        
        $.ajax({
            url:    params.ajaxurl,
            type:   'post',                
            data:   ajax_form_data
        })
        
        .done( function( response ) { // response from the PHP action
            $(" #nds_form_feedback ").html( "<h2>The request was successful </h2><br>" + response );
        })
        
        // something went wrong  
        .fail( function() {
            $(" #nds_form_feedback ").html( "<h2>Something went wrong.</h2><br>" );                  
        })
    
        // after all this time?
        .always( function() {
            event.target.reset();
        });
    
   });

})( jQuery );
