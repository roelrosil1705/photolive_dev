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

        # Get User ID
        $user = $facebook->getUser();

        if ($user) {
            try {

                # Photo Caption
                $photoCaption = $this->input->post('message');

                # Relative Path to your image.
                $file = $this->input->post('url');

                # Post Data for Photos API
                $post_data = array(
                    'message' => $photoCaption,
                    'source' => '@' . realpath( $file )
                );

                $apiResponse = $facebook->api('/me/photos', 'POST', $post_data);

            } catch (FacebookApiException $e) {
                $user = null;
                error_log($e);
            }
        } else {
            $loginUrl = $facebook->getLoginUrl( array(
                'scope' => 'publish_stream,photo_upload'
            ));
            echo("<script>top.location.href = '" . $loginUrl . "';</script>");
        }
        //end fbshare
    }

}
