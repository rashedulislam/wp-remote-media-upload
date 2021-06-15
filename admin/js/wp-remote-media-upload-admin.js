(function($) {

	$(document).on( 'submit', 'form.wp-remote-media-upload-form', function( e ) {
		e.preventDefault();

        let url = $('#image_url').val(),
            urlcheck = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|(www\\.)?){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");

        if (urlcheck.test(url)) {
            filteredurl = url;
        } else {
            swal({
                icon: "error",
                title: "Wrong URL Pattern",
                text: "Please Enter a valid URL!!!",
            });
            return;
        }

        if(filteredurl !== null && filteredurl !== '') {
            $.ajax({
                url: wp_remote_media_upload_localize.ajaxurl,
                type: 'post',
                data: {
                    _ajax_nonce: wp_remote_media_upload_localize.nonce,
                    action: wp_remote_media_upload_localize.action,
                    url: filteredurl,
                },
                success: function( response ) {
                    if (response) {
                        swal({
                            icon: "success",
                            title: "Yahoo!!!",
                            text: "File Uploaded Successfully!!!",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    } else {
                        swal({
                            icon: "error",
                            title: "Invalid URL",
                            text: "Please Enter a valid URL!!!",
                        });   
                    }
                },
                error: function () {
                    swal({
                        icon: "error",
                        text: "There was an error uploading the image!!!",
                    });
                },
            })
         }

        $('.wp-remote-media-upload-form')[0].reset();

	})
})(jQuery);
