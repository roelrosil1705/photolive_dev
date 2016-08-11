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
        /*variables*/
        $txt = 'Hello';
        /*end variable*/
        
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

        $img = $dir . 'thumbnail/' . $data['photo'];
        /* */
        $tmhOAuth = new tmhOAuth(array(
            'consumer_key' => '7jZrMbeY8td0ESJ7HFwQ',
            'consumer_secret' => 'meaiRzsdIABV8vHIXL7clcpuYYc6fPnSRmjBqQphU',
            'curl_ssl_verifypeer' => false
        ));

        $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''));
        $response = $tmhOAuth->extract_params($tmhOAuth->response["response"]);
//        echo '<pre>';

        $temp_token = $response['oauth_token'];
        $temp_secret = $response['oauth_token_secret'];
        $time = $_SERVER['REQUEST_TIME'];
        setcookie("Temp_Token", $temp_token, $time + 3600 * 30);
        setcookie("Temp_Secret", $temp_secret, $time + 3600 * 30);
        setcookie("Tweet_Txt", $txt, $time + 3600 * 30);
        setcookie("Img_Url", $img, $time + 3600 * 30);

        if(!isset($_REQUEST['oauth_verifier'])){
            $url = $tmhOAuth->url("oauth/authorize", "") . '?oauth_token=' . $temp_token;
            header("Location:".$url);
//        echo $url;
            exit();
        }

        /// retrive temp access token from cookie
        $token = $_COOKIE['Temp_Token'];
        $secret = $_COOKIE['Temp_Secret'];
        $img_u = $_COOKIE['Img_Url'];
        $txt_u = $_COOKIE['Tweet_Txt'];

        $tmhOAuth = new tmhOAuth(array(
            'consumer_key' => '7jZrMbeY8td0ESJ7HFwQ',
            'consumer_secret' => 'meaiRzsdIABV8vHIXL7clcpuYYc6fPnSRmjBqQphU',
            'user_token'      => $token,
            'user_secret'     => $secret,
            'curl_ssl_verifypeer'   => false
        ));

        /// Ask Twitter for correct access token
        $tmhOAuth->request("POST", $tmhOAuth->url("oauth/access_token", ""), array(
            // pass the oauth_verifier received from Twitter
            'oauth_verifier'    => $_GET["oauth_verifier"]
        ));

        $response = $tmhOAuth->extract_params($tmhOAuth->response["response"]);

        $tmhOAuth->config["user_token"] = $response['oauth_token'];
        $tmhOAuth->config["user_secret"] = $response['oauth_token_secret'];

//        $img_uu = './'.$img_u;
//        $img_uu = realpath($img);

//        $media = "@{$image};type=image/jpg;filename={$name}";
        $name  = basename($img);
//        $status = "Picture time";
        $media = "@".realpath($img).";type=image/jpg;filename={$name}";

        $code = $tmhOAuth->request('POST', $tmhOAuth->url('1.1/statuses/update_with_media'),
            array(
                'status'   => $txt_u, // Don't give up..
                'media[]'  => file_get_contents(realpath($img))
            ),
            true, // use auth
            true  // multipart
        );

        echo '<pre>';
        print_r($tmhOAuth);
echo $code;
        if ($code == 200){
            // tmhUtilities::pr(json_decode($tmhOAuth->response['response']));
            echo '<h1>Your image tweet has been sent successfully</h1>';
            return false;
        }else{
            // display the error
            tmhUtilities::pr($tmhOAuth->response['response']);
            return tmhUtilities;
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