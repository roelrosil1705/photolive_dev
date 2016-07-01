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

    <div id="first_view" class="row text-center">
        <div class="large-12 columns">
            <img id="imgview" src="" alt="">
        </div>
    </div>
    <div id="frameview" class="row text-center">
        <div class="row">
            <div class="column large-4 medium-4 small-12">
                <img id="frame1" src="<?=base_url('assets/front_end/frames/ss1.png')?>" alt="">
            </div>
            <div class="column large-4 medium-4 small-12">
                <img id="frame2" src="<?=base_url('assets/front_end/frames/square.png')?>" alt="">
            </div>
            <div class="column large-4 medium-4 small-12">
                <img id="frame3" src="<?=base_url('assets/front_end/frames/custom_frame1.png')?>" alt="">
            </div>
        </div>
    </div>

    <div id="camview" class="row text-center hide">
        <div class="large-12 columns">
            <div id="webcam">
            </div>
        </div>
    </div>

    <div id="shareview" class="row text-center hide">
        <div class="large-12 columns">
            <img id="preview" src="" alt="">
        </div>
    </div>
    <div class="row text-center" style="margin-top: 10px;">
        <a class="select_frame button large">Select</a>
        <a id="captureBtn" class="button large hide" id="btn2" onclick="base64_toimage()">Take a Photo</a>
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
                    console.log(response.authResponse);
//                location.href="/share/fbShareHow/<?php //echo $fbShareBy; ?>//";
                } else {
//                location.href = "/shared";
                }
            }, {scope: 'email,publish_actions,user_photos'});

        });
    </script>
</body>
</html>