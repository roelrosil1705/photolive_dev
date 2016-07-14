<!doctype html>
<html lang="en">
<?php
//    header('Content-Disposition: inline; filename="file.pdf"');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photolive</title>
    <link rel="stylesheet" href="<?=base_url('assets/css/foundation.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/foundation-icons/foundation-icons.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/app.css');?>">
    <script>
        var MyNameSpace = {
            config: {
                base_url: "<?php echo base_url(); ?>"
            }
        }
    </script>
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
    <script src="<?=base_url('assets/js/vendor/modernizr.js');?>"></script>
</head>
<body id="bdy" style="background-image: url(assets/front_end/interface/int.png);">
    <div class="row top-logo">
        <div class="large-12 columns">

        </div>
    </div>

    <div id="camview" class="row text-center">
        <div class="large-12 columns">
            <div id="webcam">
            </div>
        </div>
    </div>

    <div id="frameview" class="row text-center">
        <div class="row">
            <div class="column large-4 medium-4 small-12">
                <img id="frame1" src="<?=base_url('assets/front_end/frames/frame1.png')?>" alt="">
            </div>
            <div class="column large-4 medium-4 small-12">
                <img id="frame2" src="<?=base_url('assets/front_end/frames/frame2.png')?>" alt="">
            </div>
            <div class="column large-4 medium-4 small-12">
                <img id="frame3" src="<?=base_url('assets/front_end/frames/frame3.png')?>" alt="">
            </div>
        </div>
    </div>

    <div id="shareview" class="row text-center hide">
        <div class="large-12 columns">
            <img id="preview" src="" alt="">
        </div>
    </div>
    <div class="row text-center" style="margin-top: 10px;">
        <a id="captureBtn" class="button large" id="btn2" onclick="base64_toimage()">Take a Photo</a>
        <a class="fb button large hide">Facebook</a>
        <a class="tweet button large hide" onclick="location.href='<?php echo base_url('index.php/photolive/tweet/?authenticate=1&force=1')?>'">Twitter</a>
        <a id="ema_btn" class="button large hide"  data-reveal-id="emailModel">Email</a>
        <a class="btnPrint button large hide" href="<?=base_url('index.php/photolive/print_me');?>" target="_blank">Print</a>
    </div>
    <div id="fb-root"></div>

    <div id="successModel" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        <h2 id="modalTitle">Shared Successfully</h2>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

    <div id="emailModel" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
        <h2 id="modalTitle">Email</h2>
        <input type="text" name="inp_email" id="inp_email">
        <a class="ema button large">Email</a>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

    <script src="<?=base_url('assets/js/vendor/jquery.js');?>"></script>
    <script src="<?=base_url('assets/js/foundation.min.js');?>"></script>
    <script>
        $(document).foundation({
            abide: {
                patterns: {
                    password: /^(.){8,}$/
                }
            }
        });
    </script>
    <script src="<?=base_url('assets/js/swfobject.js');?>"></script>
    <script src="<?=base_url('assets/js/scriptcam/scriptcam.min.js');?>"></script>
    <script src="<?=base_url('assets/js/app.js')?>"></script>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '203010123089210',
                // cookie: true,
                xfbml: true,
                oauth: true,
                version: 'v2.5'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        $('.fb').click(function(){
            var str_url = document.getElementById('preview').src;
            var res = str_url.replace( MyNameSpace.config.base_url, "" );
            console.log(str_url);
            FB.login(function(response) {
                if (response.authResponse) {
                    location.href= "share/fbShare?img_url=index.php"+res;
                }
            }, {scope: 'email,publish_stream,user_photos,photo_upload'});
        });

//        $('.fb').on('click',function(){
//            FB.login(function(response) {
//                if (response.authResponse) {
////                location.href="/share/fbShare";
//                    $.ajax({
//                        url: MyNameSpace.config.base_url+'share/fbShare',
//                        type:'post',
//                        data: {
//                            'comp_img' : document.getElementById('preview').src
//                        },
//                        success: function(data) {
//                            console.log(data);
//                            // location.reload();
////                            $('#deduct_qty_total').val(data);
//                        }
//                    });
////                    console.log(document.getElementById('preview').src);
////                    var str_url = '';
////                    str_url = document.getElementById('preview').src;
////
////                    var wallPost = {
////                        message : "testing...",
////                        url: "{"+str_url+"}"
////                    };
////                    FB.api('/me/photos', 'post', wallPost , function(response) {
////                        console.log(response);
////                        if (!response || response.error) {
////                            alert('Error occured: ' + JSON.stringify(response.error));
////                        } else {
////                            alert('Post ID: ' + response);
////                        }
////                    });
//
////                    var access_token =   FB.getAuthResponse()['accessToken'];
////                    FB.api('/me/photos?access_token='+access_token, 'post', { url: document.getElementById('preview').src, access_token: access_token }, function(response) {
////                        if (!response || response.error) {
////                            alert('Error occured: ' + JSON.stringify(response.error));
////                        } else {
////                            alert('Post ID: ' + response);
////                        }
////                    });
//                } else {
////                location.href = "/shared";
//                }
//            }, {scope: 'email,publish_actions,user_photos,photo_upload'});

//        });
    </script>
</body>
</html>