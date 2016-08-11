<?php if (!defined('BASEPATH')) die();

class Share extends CI_Controller {

    public function __construct()
    {
//        header( 'Access-Control-Allow-Origin: *' );
//
//        if ( $_SERVER[ 'REQUEST_METHOD' ] == "OPTIONS" )
//        {
//            log_message( 'debug', 'Configure webserver to handle OPTIONS-request without invoking this script' );
//            header( 'Access-Control-Allow-Credentials: true' );
//            header( 'Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS' );
//            header( 'Access-Control-Allow-Headers: ACCEPT, ORIGIN, X-REQUESTED-WITH, CONTENT-TYPE, AUTHORIZATION' );
//            header( 'Access-Control-Max-Age: 86400' );
//            header( 'Content-Length: 0' );
//            header( 'Content-Type: text/plain' );
//            exit ;
//        }
        parent::__construct();
//        $this->load->library('fb/facebook');
    }

    public function fbShare()
    {
        // $img_url = $this->input->get('img_url');
        $img_url = $this->input->get('img_url');
        $acs = $this->input->get('access_token');

        // echo $file = "@".realpath(urldecode($img_url));
        // return false;

        $facebook = new Facebook\Facebook(array(
            'app_id'  => '203010123089210',
            'app_secret' => '30c0b5513c8b69476ccc666e4aa7a718',
            'default_graph_version' => 'v2.2',
        ));

        $data = [
            'message' => 'My awesome photo upload example.',
            'source' => $facebook->fileToUpload(realpath($img_url)),
        ];

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $facebook->post('/me/photos', $data, $acs);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphNode = $response->getGraphNode();

//        echo 'Photo ID: ' . $graphNode['id'];
        if( $graphNode['id'] > 0 ){
            $url = 'https://www.facebook.com/logout.php?next=' . base_url() .
                '&access_token='.$acs;
            session_destroy();
            header('Location: '.$url);
        }
//        return false;

//        $this->load->library('fb/facebook', $facebook);

//        $user = $facebook->get('/me');
//
//        if ($this->input->get('access_token')) {
//            try {
//                $user_profile = $facebook->get('/me',$this->input->get('access_token'));
//            } catch (FacebookApiException $e) {
//                //header("location:page9.php");
//                error_log($e);
//                $user = null;
//            }
//        }

//        $logoutUrl = $facebook->getLogoutUrl(
//            array(
//                'next' => "http://photolivedesktop.com"
//            ));

//        if ($user_profile) {
////            header("Location: ".$logoutUrl);
//        } else {
//            $loginUrl = $facebook->getLoginUrl(
//                array(
//                    'scope' => 'email,publish_stream,user_photos,photo_upload'
//                ));
//        }

//        if (!$user_profile) {
//            header("Location: $loginUrl");
//
//        }else{

            $album_details = array(
                "name" => html_entity_decode("Sunsilk", ENT_QUOTES, 'UTF-8'), // Album Name ()
                "message" => "Sunsilk" // Album Description
            );

            $albums = $facebook->post('/me/albums', $album_details, $acs);

            $album_uid = null;
            foreach ($albums['data'] as $album) {
                //Test if the current album name is already in facebook
                if($album['name'] == $album_details['name']) {
                    $album_uid = $album['id'];
                }
            }
            set_time_limit (200);
            if (!$album_uid) {
                // No valid album exists, create new album here
                $create_album = $facebook->post('/me/albums', $albums, $acs);

                //Get album ID of the album you've just created
                $album_uid = $create_album['id'];
            }

//            $file = "@".realpath($img_url);
//            $facebook->setFileUploadSupport(true);
            $args = array('message' => 'Photo Caption');
//            $args['source'] = '@' . realpath($img_url);
            $args['source'] = $facebook->fileToUpload(realpath($img_url));

            $data = $facebook->post('/me/photos', $args, $acs);
            print_r($data);
            return false;

//            $photo_details = array(
//                'image' => $file,
//                'message' => html_entity_decode("Sunsilk", ENT_QUOTES, 'UTF-8') // Photo Description ()
//            );
//
//            $upload_photo = $facebook->post('/'.$album_uid.'/photos', 'post', $photo_details);
//            if ($upload_photo) {
//                header("Location: ".$logoutUrl);
//                session_destroy();
//            }
//            session_destroy();
//        }
    }

}
