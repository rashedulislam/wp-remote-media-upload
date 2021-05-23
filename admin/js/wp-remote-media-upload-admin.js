jQuery(document).ready(function($){
	'use strict';

	$( 'form.wp-remote-media-upload-form' ).on('submit', function(e){
            
        e.preventDefault();

        let urls = $('#image_urls').val();

        console.log(wp_remote_media_upload_localize.ajaxurl);
        console.log(wp_remote_media_upload_localize.action);
        
        $.ajax({
            url: wp_remote_media_upload_localize.ajaxurl,
            type:"POST",                
            data: {
                action : wp_remote_media_upload_localize.action,
                urls: urls,
           },
           success: function(response){
            console.log(response);
           },
           error: function(data){
            console.log(data);
           }
        });
        
        $('.wp-remote-media-upload-form')[0].reset();
    });
    
});
