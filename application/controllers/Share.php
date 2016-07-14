<?php if (!defined('BASEPATH')) die();

class Share extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fb/facebook');
    }

    public function fbShare()
    {
        $img_url = $this->input->get('comp_img');

         echo $file = "@".realpath(urldecode($img_url));
         return false;

        $facebook = new Facebook(array(
            'appId'  => '203010123089210',
            'secret' => '30c0b5513c8b69476ccc666e4aa7a718',
            'fileUpload' => true
        ));

        $this->load->library('fb/facebook', $facebook);

        $user = $facebook->getUser();

        $logoutUrl = $facebook->getLogoutUrl(
            array(
                'next' => "http://photolivedesktop.com"
            ));

        if ($user) {
            header("Location: ".$logoutUrl);
        } else {
            $loginUrl = $facebook->getLoginUrl(
                array(
                    'scope' => 'email,publish_stream,user_photos,photo_upload'
                ));
        }

        if (!$user) {
            header("Location: $loginUrl");

        }else{

            $facebook->setFileUploadSupport(true);

            $album_details = array(
                "name" => html_entity_decode("Sunsilk", ENT_QUOTES, 'UTF-8'), // Album Name ()
                "message" => "Sunsilk" // Album Description
            );

            $albums = $facebook->api('/me/albums');

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
                $create_album = $facebook->api('/me/albums', 'post', $album_details);

                //Get album ID of the album you've just created
                $album_uid = $create_album['id'];
            }

            $file = "@".realpath($img_url);

            $photo_details = array(
                'image' => $file,
                'message' => html_entity_decode("Sunsilk", ENT_QUOTES, 'UTF-8') // Photo Description ()
            );

            $upload_photo = $facebook->api('/'.$album_uid.'/photos', 'post', $photo_details);
            if ($upload_photo) {
                header("Location: ".$logoutUrl);
                session_destroy();
            }
            session_destroy();
        }

        //end fbshare
    }

}
