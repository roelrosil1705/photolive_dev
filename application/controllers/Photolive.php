<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photolive extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct() {
        parent::__construct();
        $this->load->library('phpmailer/phpmailer');
        $this->load->library('twitter/tmhOAuth');
        $this->load->library('twitter/tmhUtilities');
        $this->load->library('SimpleImage');

        /*email*/
        // The mail sending protocol.
        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/sbin/sendmail"; // or "/usr/bin/sendmail"
        $config['protocol'] = 'smtp';
        // SMTP Server Address for Gmail.
        $config['smtp_host'] = 'mail.cloudwalkdigital.com';
        // SMTP Port - the port that you is required
        $config['smtp_port'] = 26;
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['crlf']  = "\r\n";
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;
        // SMTP Username like. (abc@gmail.com)
        $config['smtp_user'] = 'roel.r@cloudwalkdigital.com';
        // SMTP Password like (abc***##)
        $config['smtp_pass'] = 'Cloud2468';
        // Load email library and passing configured values to email library
//        $this->load->library('email', $config);
        $this->load->library('email');

        $this->email->initialize($config);
    }

    public function index()
    {
        $this->load->view('main');
//        $this->load->view('page1camera');
    }

    public function print_img(){
        $file = date('YmdGis');
        $contents = $this->input->post('contents');
        $encodedData = str_replace(' ','+',$contents);
        $decodedData = base64_decode($encodedData);
        $fp = fopen( 'assets/temp/'.$file.'.jpg', 'w' );

        fwrite($fp, $decodedData);
        fclose($fp);

        echo $this->merge_image( 'assets/temp/'.$file.'.jpg', $this->input->post('frame') );
    }

    function merge_image( $imgloc = null, $frmloc = null ){
        list($bg_width, $bg_height) = getimagesize($frmloc);  // for cms db
        list($bg_widtha, $bg_heighta) = getimagesize($imgloc);
//        print_r($bg_widtha.'>'.$bg_heighta);
        $im = imagecreatetruecolor($bg_width,$bg_height) or die('Cannot Initialize new GD image stream');
        $iTmp = imageCreateFromJPEG($imgloc);
        $iFrame = imageCreateFromPNG($frmloc);
        imagecopymerge($im, $iTmp, 0, 0, 0, 0, $bg_widtha, $bg_heighta, 100);
        imagecopy($im, $iFrame, 0, 0, 0, 0, $bg_width, $bg_height);

        $outfile = "assets/uploaded/" . date('YmdHis') . "single.jpg";
        $quality = 90;
        imagejpeg($im,$outfile,$quality);
        imagedestroy($im);

        return $outfile;
    }

    function print_me(){
        $this->load->view('print');
    }

    public function tweet()
    {
        $tmhOAuth = new tmhOAuth(array(
            'consumer_key'    => '7jZrMbeY8td0ESJ7HFwQ',
            'consumer_secret' => 'meaiRzsdIABV8vHIXL7clcpuYYc6fPnSRmjBqQphU',
        ));
        $here = tmhUtilities::php_self();

        function outputError($tmhOAuth) {
            echo 'Error: ' . $tmhOAuth->response['response'] . PHP_EOL;
            tmhUtilities::pr($tmhOAuth);
        }

        if ( isset($_REQUEST['wipe'])) {
            session_destroy();
            header("Location: {$here}");

            // already got some credentials stored?
        } elseif ( isset($_SESSION['access_token']) ) {
            $tmhOAuth->config['user_token']  = $_SESSION['access_token']['oauth_token'];
            $tmhOAuth->config['user_secret'] = $_SESSION['access_token']['oauth_token_secret'];

            $code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/account/verify_credentials'));

            if ($code == 200) {
                $resp = json_decode($tmhOAuth->response['response']);

                $dir = 'assets/uploaded/';
                $folder = scandir($dir,1);
                foreach($folder as $img) {
                    if(is_file($dir.$img) && $img != 'Thumbs.db') {
                        $data['photo'] = $img;
                        break;
                    }
                }

                /* resize image */
                $thumbnail_dir = $dir . 'thumbnail/';
                var_dump( is_dir($thumbnail_dir));
                if(!is_dir($thumbnail_dir)) {
                    mkdir($thumbnail_dir, 0777,true);
                }

                $image = new SimpleImage();
                $image->load($dir . $data['photo']);
                // $image->resizeToWidth(502);
                $image->scale(70); /* resize down to 70% */
                $image->save($dir . 'thumbnail/' . $data['photo']);

                $twitimg = $dir . 'thumbnail/' . $data['photo'];
                /* */

                echo $dir . $data['photo'];
                echo 'thumb > ' . $dir . 'thumbnail/' . $data['photo'];

                $params = array(
                    'status' =>'Testing',
                    'media' => "@".realpath($twitimg)
                );

                $code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update_with_media'),$params,TRUE, TRUE);
            }
        } elseif (isset($_REQUEST['oauth_verifier'])) {
            $tmhOAuth->config['user_token']  = $_SESSION['oauth']['oauth_token'];
            $tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];

            $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/access_token', ''), array(
                'oauth_verifier' => $_REQUEST['oauth_verifier']
            ));

            if ($code == 200) {
                $_SESSION['access_token'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
                unset($_SESSION['oauth']);
                header("Location: {$here}");
            } else {
                outputError($tmhOAuth);
                // redirect('photolivedesktop.com/shared');
                // redirect(base_url().'shared');
//                redirect('shared');
                session_destroy();
            }
            // start the OAuth dance http://www.photolivedesktop.com/assets/php/tweet.php?authenticate=1&force=1
        } elseif ( isset($_REQUEST['authenticate']) || isset($_REQUEST['authorize']) ) {
            $callback = isset($_REQUEST['oob']) ? 'oob' : $here;

            $params = array(
                'oauth_callback'     => $callback
            );

            if (isset($_REQUEST['force_write'])) :
                $params['x_auth_access_type'] = 'write';
            elseif (isset($_REQUEST['force_read'])) :
                $params['x_auth_access_type'] = 'read';
            endif;

            $code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), $params);

            if ($code == 200) {
                $_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
                $method = isset($_REQUEST['authenticate']) ? 'authenticate' : 'authorize';
                $force  = isset($_REQUEST['force']) ? '&force_login=1' : '';
                $authurl = $tmhOAuth->url("oauth/{$method}", '') .  "?oauth_token={$_SESSION['oauth']['oauth_token']}";
                header("Location: " . $authurl);

            } else {
                outputError($tmhOAuth);
                // redirect('photolivedesktop.com/shared');
//                redirect('shared');
                // redirect(base_url().'shared');
                // $this->load->view('shared_successfully');
                session_destroy();
            }
        }

    }

    function email_share(){
        $mail = new PHPMailer();
        $body =	"Hello";
        $str_rep = str_replace(base_url(),'',$this->input->post('img'));

        $mail->IsSMTP(); // telling the class to use SMTP
        // $mail->Host       = "mail.photolive.com.ph"; // SMTP server	// if not work change to cloudwalkdigital SMTP server
        $mail->Host       = "mail.cloudwalkdigital.com"; // SMTP server	// if not work change to cloudwalkdigital SMTP server
        $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = "mail.cloudwalkdigital.com"; // sets the SMTP server	// if not work change to cloudwalkdigital SMTP server
        $mail->Port       = 26;                    // set the SMTP port for the GMAIL server
        // $mail->Username   = "send@photolive.com.ph"; // SMTP account username
        $mail->Username   = "whatsup@cloudwalkdigital.com"; // SMTP account username	// if not work change to cloudwalkdigital account username
        // $mail->Password   = "photo2468";        // SMTP account password		// if not work change to cloudwalkdigital account password
        $mail->Password   = "cloud2468";        // SMTP account password		// if not work change to cloudwalkdigital account password
        $mail->SetFrom('whatsup@cloudwalkdigital.com', 'PhotoLive');		// if not work change to cloudwalkdigital account username
        $mail->AddAddress($this->input->post('email_val'));
        $mail->AddReplyTo("whatsup@cloudwalkdigital.com","PhotoLive");		// if not work change to cloudwalkdigital account username send@photolive.com.ph,  whatsup@cloudwalkdigital.com

        $mail->Subject    = (!empty($content['email_subject']))? $content['email_subject']  : "Havaianas photo";

        $mail->AltBody    = "PhotoTitle"; // optional, comment out and test
        $mail->MsgHTML($body);

        $mail->AddAttachment( $str_rep );      // attachment
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
}
