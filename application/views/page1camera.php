<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Photolive</title>
    <link rel="stylesheet" href="<?=base_url('assets/foundation/css/foundation.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/foundation/css/app.css');?>">
    <script src="<?=base_url('assets/js/jquery-1.12.4.min.js');?>"></script>
    <script src="<?=base_url('assets/js/swfobject.js');?>"></script>
    <script src="<?=base_url('assets/js/scriptcam/scriptcam.min.js');?>"></script>
    <link rel="stylesheet" href="<?=base_url('assets/foundation/js/app.js');?>">
    <script>
        var MyNameSpace = {
            config: {
                base_url: "<?php echo base_url(); ?>"
            }
        }
    </script>
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
        <a class="ema button large hide">Email</a>
        <a class="btnPrint button large hide" href="<?=base_url('index.php/photolive/print_me');?>" target="_blank">Print</a>
    </div>
<!--    <div class="row bot-logo">-->
<!--        <div class="large-12 columns">-->
<!---->
<!--        </div>-->
<!--    </div>-->
    <div id="fb-root"></div>

    <script src="<?=base_url('assets/foundation/js/vendor/foundation.js')?>"></script>
    <script src="<?=base_url('assets/foundation/js/app.js')?>"></script>
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

        $('.fb').on('click',function(){
            FB.login(function(response) {
                if (response.authResponse) {
//                location.href="/share/fbShare";
//                    $.ajax({
//                        url: MyNameSpace.config.base_url+'share/fbShare',
//                        type:'post',
//                        data: {
//                            'comp_img' : document.getElementById('preview').src
//                        },
//                        success: function(data) {
//                            //console.log(data);
//                            // location.reload();
////                            $('#deduct_qty_total').val(data);
//                        }
//                    });
                    console.log(document.getElementById('preview').src);

                    var wallPost = {
                        message : "testing...",
                        picture: document.getElementById('preview').src
                    };
                    FB.api('/me/feed', 'post', wallPost , function(response) {
                        if (!response || response.error) {
                            alert('Error occured: ' + JSON.stringify(response.error));
                        } else {
                            alert('Post ID: ' + response);
                        }
                    });

//                    var access_token =   FB.getAuthResponse()['accessToken'];
//                    FB.api('/me/photos?access_token='+access_token, 'post', { url: document.getElementById('preview').src, access_token: access_token }, function(response) {
//                        if (!response || response.error) {
//                            alert('Error occured: ' + JSON.stringify(response.error));
//                        } else {
//                            alert('Post ID: ' + response);
//                        }
//                    });
                } else {
//                location.href = "/shared";
                }
            }, {scope: 'email,publish_actions,user_photos'});

        });
    </script>
</body>
</html>