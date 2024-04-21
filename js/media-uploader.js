jQuery(document).ready(function($) {
    // Setup for media uploader
    var mediaUploader;

    $('#upload-button').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#image-url').val(attachment.url);
            $('#image-preview').html('<img src="' + attachment.url + '" style="width: 50px;"></img>'); 
        });
        mediaUploader.open();
    });

    $('#upload-button').click(function() {
        $('#icon-picker').hide(); 
    });

    $('.fa-icon-picker').click(function() {
        var iconClass = $(this).data('icon');
        $('#image-url').val(iconClass);
        $('#icon-picker').show(); // Показываем иконки
    });
});
