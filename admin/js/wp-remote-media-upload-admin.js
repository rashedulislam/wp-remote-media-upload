(function($) {
	$(document).on( 'submit', 'form.wp-remote-media-upload-form', function( e ) {
		e.preventDefault();
        let urls = $('#image_urls').val();
        const splitreg = /[\s,|]+/;
        const urlcheck = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|(www\\.)?){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
        let imageurls = urls.split(splitreg);

        let filteredurls = imageurls.filter((url) => {
            return urlcheck.test(url);
        });
        console.log(imageurls);
		console.log(filteredurls);
        $.ajax({
            url: wp_remote_media_upload_localize.ajaxurl,
            type: 'post',
            data: {
                _ajax_nonce: wp_remote_media_upload_localize.nonce,
                action: wp_remote_media_upload_localize.action,
                urls: filteredurls,
            },
            success: function( result ) {
                console.log( result );
            }
        })

        $('.wp-remote-media-upload-form')[0].reset();

	})
})(jQuery);
