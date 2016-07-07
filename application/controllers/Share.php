<?php if (!defined('BASEPATH')) die();

class Share extends Main_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('fb/facebook');
    }

    public function fbShare()
    {
        $facebook = new Facebook(array(
            'appId'  => '203010123089210',
            'secret' => '30c0b5513c8b69476ccc666e4aa7a718',
            'fileUpload' => true
        ));

        $user = $facebook->getUser();


        if ($user) {
            try {
                $user_profile = $facebook->api('/me');

            } catch (FacebookApiException $e) {
                //header("location:page9.php");
                error_log($e);
                $user = null;
            }
        }

        if ($user) {
            $logoutUrl = $facebook->getLogoutUrl(
                array(
                    'next' => base_url()
                ));
        } else {
            $loginUrl = $facebook->getLoginUrl(
                array(
                    'scope' => 'email,publish_actions,user_photos'
                ));
        }

        if (!$user) {
            header("Location: $loginUrl");

        }else{

            $photo = $this->Photos->getPhotoByName($this->input->post('comp_img'));

            $facebook->setFileUploadSupport(true);
            $album_details = array(
                "name" => html_entity_decode("Photolive", ENT_QUOTES, 'UTF-8'), // Album Name ()
                "message" => "Havaianas" // Album Description
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

            $file = "@".realpath($dir.$data['photo']);

            if ($content) {
                $photo_details = array(
                    "image" => $file,
                    "link" => 'https://www.facebook.com/pages/Capitol-Commons/396767453772311',

                    'message' => html_entity_decode($content['fb_caption'], ENT_QUOTES, 'UTF-8')// Photo Description ()
                );
            }else{
                $photo_details = array(
                    "image" => $file,
                    'message' => html_entity_decode("Havaianas", ENT_QUOTES, 'UTF-8') // Photo Description ()
                );
            }

            $upload_photo = $facebook->api('/'.$album_uid.'/photos', 'post', $photo_details);
            if ($upload_photo) {
                // header("Location: photolivedesktop.com/shared");
                redirect('shared');
                // $this->load->view('shared_successfully');
                session_destroy();
            }
            session_destroy();
        }

        //end fbshare
    }

}
