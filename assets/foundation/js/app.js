var img_type = '';

$(document).ready(function() {
    $("#webcam").scriptcam({
        width: 960,
        height: 720,
        showMicrophoneErrors:false,
        onError:onError,
        cornerRadius:20,
        disableHardwareAcceleration:1,
//                cornerColor:'e3e5e2',
//                onWebcamReady:onWebcamReady,
//                uploadImage:MyNameSpace.config.base_url+'assets/js/scriptcam/upload.gif',
        onPictureAsBase64:base64_toimage
    });
});

function base64_toimage() {
    // $('#imgview').attr('src', 'data:image/png;base64,'+$.scriptcam.getFrameAsBase64());
    // $('#camview').addClass('hide');
    // $('#captureBtn').addClass('hide');
    // $('.select_frame').removeClass('hide');
    // $('#frameview').removeClass('hide');
           $.ajax
           ({
               url: "index.php/photolive/print_img",
               type: 'post',
               crossDomain: true,
               data: {
                   'frame': img_type,
                   'contents': $.scriptcam.getFrameAsBase64()
               },
               cache: false,
               success: function (html) {
//                    console.log(html);
                   $('#camview').addClass('hide');
                   $('#captureBtn').addClass('hide');
                   $('#frameview').addClass('hide');
                   $('#shareview').removeClass('hide');
                   // $('.fb').removeClass('hide');
                   // $('.tweet').removeClass('hide');
                   $('.ema').removeClass('hide');
                   $('.btnPrint').removeClass('hide');
                   $('#preview').attr('src', html);
               }
           });

};
function onError(errorId,errorMsg) {
    $( "#btn2" ).attr( "disabled", true );
    alert(errorMsg);
}

$('.select_frame').on('click',function (e) {
    e.preventDefault();
    $(this).addClass('hide');
    $('#first_view').addClass('hide');
    $('#frameview').addClass('hide');
    
    $('#camview').removeClass('hide');
    $('#captureBtn').removeClass('hide');
});

$('#frame1').on('click',function (e) {
    e.preventDefault();
    img_type = document.getElementById('frame1').src;
    $(this).css({"-moz-box-shadow": "0 0 15px #fff", "-webkit-box-shadow": "0 0 15px #fff", "box-shadow": "0 0 15px #fff"});
    $('#frame2, #frame3').css({"-moz-box-shadow": "0 0 0 #fff", "-webkit-box-shadow": "0 0 0 #fff", "box-shadow": "0 0 0 #fff"});
});

$('#frame2').on('click',function (e) {
    e.preventDefault();
    img_type = document.getElementById('frame2').src;
    $(this).css({"-moz-box-shadow": "0 0 15px #fff", "-webkit-box-shadow": "0 0 15px #fff", "box-shadow": "0 0 15px #fff"});
    $('#frame1, #frame3').css({"-moz-box-shadow": "0 0 0 #fff", "-webkit-box-shadow": "0 0 0 #fff", "box-shadow": "0 0 0 #fff"});
});

$('#frame3').on('click',function (e) {
    e.preventDefault();
    img_type = document.getElementById('frame3').src;
    $(this).css({"-moz-box-shadow": "0 0 15px #fff", "-webkit-box-shadow": "0 0 15px #fff", "box-shadow": "0 0 15px #fff"});
    $('#frame1, #frame2').css({"-moz-box-shadow": "0 0 0 #fff", "-webkit-box-shadow": "0 0 0 #fff", "box-shadow": "0 0 0 #fff"});
});

$('.ema').on('click',function (e) {
    e.preventDefault();
    $.ajax
    ({
        url: "index.php/photolive/email_share",
        type: 'post',
        crossDomain: true,
        data: {
            'img': document.getElementById('preview').src
        },
        cache: false,
        success: function (html) {
                   console.log(html);
//             $('#camview').addClass('hide');
//             $('#captureBtn').addClass('hide');
//             $('#frameview').addClass('hide');
//             $('#shareview').removeClass('hide');
//             $('.fb').removeClass('hide');
//             $('.tweet').removeClass('hide');
//             $('.ema').removeClass('hide');
            // $('.btnPrint').removeClass('hide');
            // $('#preview').attr('src', html);
        }
    });
});
