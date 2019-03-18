$(document).ready(function() {

    $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square' //circle
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload_image').on('change', function() {
        var reader = new FileReader();
        reader.onload = function(event) {
            $image_crop.croppie('bind', {
                url: event.target.result
            }).then(function() {
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
    });

    $('.crop_image').click(function(event) {
        $image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response) {
            $('#image').attr('value', response);
            $('#uploadimageModal').modal('hide');
        })
    });

});