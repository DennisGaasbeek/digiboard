<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct()
    {
        parent::__construct();

		error_reporting(1);
        ini_set('display_errors', 1);
		date_default_timezone_set('Europe/Amsterdam');
		
        $data = array('web_title' => 'Digiboard Businessclub de Heuvelrug', 'logo' => 'data/img/logo_200_45.png');
        $this->load->vars($data);

        //mail config
        $mailconfig = Array(
        'protocol' => 'smtp',
        'smtp_host' => '92.65.78.74',
        'smtp_port' => 26,
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
        );

    }

    public function login()
    {

        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/footer');

    }

	public function access()
	{

		//get post value
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');
		$pass = md5($pass);

		//get account
		$account = $this->Get->CheckAccount($user,$pass);
		//check login
		$count = count($account);

		//get the data
		foreach($account as $account){}
		if($count == 0){
		$data['status'] = 'invalid';

        //output
        $this->load->view('template/header');
        $this->load->view('login', $data);
        $this->load->view('template/footer');

		}else{

			//set keys in session
			$data = array('account' => $account->id, 'user' => $user, 'pass' => $pass, 'name' => $account->name);
			$this->session->set_userdata($data);
            //log date of login
            $this->Add->LogLoginDate($account->id);

			redirect('/admin', 'refresh');

		}

	}

	public function reset()
	{

		$this->load->view('template/header');
		$this->load->view('reset');
        $this->load->view('template/footer');

	}

	public function recover()
	{

        $input = strtolower($this->input->post('user'));
        $user = $this->Get->CheckRecovery($input);
        $count = count($user);
        if($count == 0){
            $data['msg'] = 'invalid';

    		$this->load->view('template/header');
    		$this->load->view('reset',$data);
            $this->load->view('template/footer');

        }else{

            //send reset mail
            foreach($user as $user){

    			//send mail
    			$this->load->library('email', $mailconfig);
                $from = 'noreply@businessheuvelrug.nl';
                $url = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", base_url());
    			$this->email->from($from, 'Digiboard Businessclub de Heuvelrug');
    			$this->email->to($user->mail);
    			$this->email->subject('Reset van uw account voor de Digiboard app van Businessclub de Heuvelrug.');
            	$this->email->set_mailtype('html');

                $mail = str_replace('=', '',base64_encode($input));
                $name = str_replace('=', '',base64_encode($user->name));
                $link = base_url().'Main/restore/'.$mail.'/'.$name;

            	$message = "
                <html>
                <head>
                <style>
                body{
                padding: 10px;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 11pt;
                color: #575757;
                }

                .kop{
                color: #fff;
                background-color: #000;
                }

                .content{
                background-color: #fff;
                color: #000;
                }
                </style>
                </head>
                <body>
                <div class=\"kop\">
                <br />
                &nbsp;&nbsp;<img align=\"left\" src=\"data:image/png;base64,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\" width=\"200\" height=\"45\">
                <br /><br /><br />
                </div>
                <br />
                <table style=\"margin-left:40px;\">
                <tr>
                <td>
                <p>Beste $user->name,</p>
                <p>Er is een wachtwoordherstel aangevraagd. Volg onderstaande link om een nieuw wachtwoord te genereren.<br />
                $link
                <br />
                Mocht de reset niet door u zijn aangevraagd, verwijder dan deze mail.</p>
                </td>
                </tr>
                </table>
                </body>
                </html>";

    			$this->email->message($message);
    			$this->email->send();

                $data['msg'] = 'valid';

        		$this->load->view('template/header');
        		$this->load->view('reset',$data);
                $this->load->view('template/footer');

            }

        }

	}

	public function restore()
	{

        $user = base64_decode($this->uri->segment(3));
        $name = base64_decode($this->uri->segment(4));

        //get userdata
        $user = $this->Get->InitRecovery($user,$name);
            if(count($user) > 0){

                foreach($user as $user){

    			//get id
    			$id = $user->id;

    			//generate password
    			$password = bin2hex(random_bytes(5));
    			$md5 = md5($password);

    			//update user in database
    			$this->Add->PassReset($id, $md5);

    			//send mail
    			$this->load->library('email', $mailconfig);
                $from = 'noreply@businessheuvelrug.nl';
                $url = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", base_url());
    			$this->email->from($from, 'Digiboard Businessclub de Heuvelrug');
    			$this->email->to($user->mail);
    			$this->email->subject('Reset van uw account voor de Digiboard app van Businessclub de Heuvelrug.');
            	$this->email->set_mailtype('html');

            	$message = "
                <html>
                <head>
                <style>
                body{
                padding: 10px;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 11pt;
                color: #575757;
                }

                .kop{
                color: #fff;
                background-color: #000;
                }

                .content{
                background-color: #fff;
                color: #000;
                }
                </style>
                </head>
                <body>
                <div class=\"kop\">
                <br />
                &nbsp;&nbsp;<img align=\"left\" src=\"data:image/png;base64,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\" width=\"200\" height=\"45\">
                <br /><br /><br />
                </div>
                <br />
                <table style=\"margin-left:40px;\">
                <tr>
                <td>
                <p>Beste $name,</p>
                <p>Uw nieuwe wachtwoord is:<br />
                <strong>$password</strong></p>
                </td>
                </tr>
                </table>
                </body>
                </html>";

    			$this->email->message($message);
    			$this->email->send();

                $data['msg'] = 'restored';

        		$this->load->view('template/header');
        		$this->load->view('reset',$data);
                $this->load->view('template/footer');

            }

        }else{

                $data['msg'] = 'incorrect_link';

        		$this->load->view('template/header');
        		$this->load->view('reset',$data);
                $this->load->view('template/footer');


        }

    }

	public function index()
    {

        $data['slides'] = $this->Get->GetSelectedSlides();
        $data['settings'] = $this->Get->GetSettings();

        $this->load->view('template/header');
        $this->load->view('home',$data);
        $this->load->view('template/footer');

	}

	public function admin()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['slides'] = $this->Get->GetSlides();

			$this->load->view('template/header');
			$this->load->view('admin', $data);
            $this->load->view('template/footer');

			}

	}

	public function save_order()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

    			$input = $this->input->post('order');

                foreach($input as $slideorder){

                $data = explode('.', $slideorder);
                $id = $data[1];
                $order = $data[0];

                $this->Add->SetOrder($order,$id);


                }

                redirect('/admin', 'refresh');

			}

	}

	public function settings()
    {

        $data['settings'] = $this->Get->GetSettings();

        $this->load->view('template/header');
        $this->load->view('settings',$data);
        $this->load->view('template/footer');

	}

	public function save_settings()
    {

	    $tt_page = $this->input->post('page');
		$tt_on = $this->input->post('active');

        //save to database
        $this->Add->SaveSettings($tt_page, $tt_on);

        redirect('/settings', 'refresh');

	}

	public function add_slide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['sponsors'] = $this->Get->GetSponsors();
            $data['events'] = $this->Get->GetValidEvents();
            $data['messages'] = $this->Get->GetMessages();

			$this->load->view('template/header');
			$this->load->view('add_slide', $data);
            $this->load->view('template/footer');

			}

	}

	public function add_videoslide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_videoslide', $data);
            $this->load->view('template/footer');

			}

	}

	public function save_slide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $discription = $this->input->post('discription');
			$title = $this->input->post('title');
			$content = $this->input->post('content');
            $active = $this->input->post('active');
            $wallpaper = $this->input->post('wallpaper');
            $font = $this->input->post('font');
            $checkbox = $this->input->post('chk');
            $duration = $this->input->post('delay');
            $duration = $duration + 15;
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = $_FILES['file']['size'];

                if(($filesize < 750000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    $image = date('YmdHis').'.'.$extention;
                    move_uploaded_file($file, "./data/uploads/$image");

    				foreach($checkbox as $value){

    				$entry = explode("&", $value);
                    $type = $entry[0];
                    $id = $entry[1];

                        if($type == 'e'){ $events[] = $id; }
                        if($type == 'm'){ $messages[] = $id; }
                        if($type == 's'){ $sponsors[] = $id; }
                    }

                    $events = implode(",", $events);
                    $messages = implode(",", $messages);
                    $sponsors = implode(",", $sponsors);

                    if($events == ''){ $events = ''; }
                    if($messages == ''){ $messages = ''; }
                    if($sponsors == ''){ $sponsors = ''; }

        			//save to database
        			$this->Add->AddSlide($discription, $title, $content, $image, $active, $events, $messages, $sponsors, $wallpaper,$font,$duration);

                    redirect('/admin', 'refresh');

                }elseif($filename == ''){

                    $image = '';

    				foreach($checkbox as $value){

    				$entry = explode("&", $value);
                    $type = $entry[0];
                    $id = $entry[1];

                        if($type == 'e'){ $events[] = $id; }
                        if($type == 'm'){ $messages[] = $id; }
                        if($type == 's'){ $sponsors[] = $id; }
                    }

                    $events = implode(",", $events);
                    $messages = implode(",", $messages);
                    $sponsors = implode(",", $sponsors);

                    if($events == ''){ $events = ''; }
                    if($messages == ''){ $messages = ''; }
                    if($sponsors == ''){ $sponsors = ''; }

        			//save to database
        			$this->Add->AddSlide($discription, $title, $content, $image, $active, $events, $messages, $sponsors, $wallpaper,$font,$duration);

                    redirect('/admin', 'refresh');

                }else{

                $data['msg'] = 'invalid';
                $data['sponsors'] = $this->Get->GetSponsors();
                $data['events'] = $this->Get->GetValidEvents();
                $data['messages'] = $this->Get->GetMessages();

    			$this->load->view('template/header');
    			$this->load->view('add_slide', $data);
                $this->load->view('template/footer');

                }


			}

	}

	public function mod_slide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $data['sponsors'] = $this->Get->GetSponsors();
            $data['events'] = $this->Get->GetValidEvents();
            $data['messages'] = $this->Get->GetMessages();
            $data['slide'] = $this->Get->GetSlide($id);

			$this->load->view('template/header');
			$this->load->view('mod_slide', $data);
            $this->load->view('template/footer');

			}

	}

	public function mod_videoslide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $data['slide'] = $this->Get->GetSlide($id);

			$this->load->view('template/header');
			$this->load->view('mod_videoslide', $data);
            $this->load->view('template/footer');

			}

	}

	public function update_slide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $itemid = $this->uri->segment(3);
            $discription = $this->input->post('discription');
			$title = $this->input->post('title');
			$content = $this->input->post('content');
            $active = $this->input->post('active');
            $wallpaper = $this->input->post('wallpaper');
            $font = $this->input->post('font');
            $checkbox = $this->input->post('chk');
            $duration = $this->input->post('delay');
            $duration = $duration + 15;
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = $_FILES['file']['size'];

                if($filename == ''){

    				foreach($checkbox as $value){

    				$entry = explode("&", $value);
                    $type = $entry[0];
                    $id = $entry[1];

                        if($type == 'e'){ $events[] = $id; }
                        if($type == 'm'){ $messages[] = $id; }
                        if($type == 's'){ $sponsors[] = $id; }
                    }

                    $events = implode(",", $events);
                    $messages = implode(",", $messages);
                    $sponsors = implode(",", $sponsors);

                    if($events == ''){ $events = ''; }
                    if($messages == ''){ $messages = ''; }
                    if($sponsors == ''){ $sponsors = ''; }

        			$this->Add->UpdateSlideKeepImage($itemid, $discription, $title, $content, $active, $events, $messages, $sponsors, $wallpaper, $font, $duration);
                    redirect('/admin', 'refresh');

                }elseif(($filesize < 750000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    //remove old image
                    $oldslide = $this->Get->GetSlide($itemid);
                    foreach($oldslide as $oldslide){

                    unlink('./data/uploads/'.$oldslide->image);
                    }


                    $image = date('YmdHis').'.'.$extention;
                    move_uploaded_file($file, "./data/uploads/$image");

    				foreach($checkbox as $value){

    				$entry = explode("&", $value);
                    $type = $entry[0];
                    $id = $entry[1];

                        if($type == 'e'){ $events[] = $id; }
                        if($type == 'm'){ $messages[] = $id; }
                        if($type == 's'){ $sponsors[] = $id; }
                    }

                    $events = implode(",", $events);
                    $messages = implode(",", $messages);
                    $sponsors = implode(",", $sponsors);

                    if($events == ''){ $events = ''; }
                    if($messages == ''){ $messages = ''; }
                    if($sponsors == ''){ $sponsors = ''; }

        			//save to database
        			$this->Add->UpdateSlide($itemid, $discription, $title, $content, $image, $active, $events, $messages, $sponsors, $wallpaper, $font, $duration);
                    redirect('/admin', 'refresh');

                }else{

                $data['msg'] = 'invalid';
                $data['sponsors'] = $this->Get->GetSponsors();
                $data['events'] = $this->Get->GetValidEvents();
                $data['messages'] = $this->Get->GetMessages();

    			$this->load->view('template/header');
    			$this->load->view('mod_slide', $data);
                $this->load->view('template/footer');

                }


			}

	}

	public function del_slide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $slide = $this->Get->GetSlide($id);
            foreach($slide as $slide){

            unlink('./data/uploads/'.$slide->image);

            }


            $this->Del->DelSlide($id);

			redirect('/admin', 'refresh');

			}

	}

	public function save_videoslide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $discription = $this->input->post('discription');
			$youtube = $this->input->post('youtube');
            $active = $this->input->post('active');
            $wallpaper = $this->input->post('wallpaper');
            $duration = $this->input->post('delay');
            $duration = $duration + 15;

                if($events == ''){ $events = ''; }
                if($messages == ''){ $messages = ''; }
                if($sponsors == ''){ $sponsors = ''; }

    			//save to database
    			$this->Add->AddVideoSlide($discription,$youtube, $active,$wallpaper,$duration);

                redirect('/admin', 'refresh');

			}

	}

	public function update_videoslide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $discription = $this->input->post('discription');
			$youtube = $this->input->post('youtube');
            $active = $this->input->post('active');
            $wallpaper = $this->input->post('wallpaper');
            $duration = $this->input->post('delay');
            $duration = $duration + 15;

                if($events == ''){ $events = ''; }
                if($messages == ''){ $messages = ''; }
                if($sponsors == ''){ $sponsors = ''; }

    			//save to database
    			$this->Add->ModVideoSlide($id,$discription,$youtube, $active,$wallpaper,$duration);

                redirect('/admin', 'refresh');

			}

	}

	public function users()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['users'] = $this->Get->GetUsers();

			$this->load->view('template/header');
			$this->load->view('users', $data);
            $this->load->view('template/footer');

			}

	}

	public function add_user()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_user');
            $this->load->view('template/footer');

			}

	}

	public function save_user()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$name = $this->input->post('name');
			$mail = strtolower($this->input->post('mail'));
            $phone = $this->input->post('phone');

			//generate password
			$password = bin2hex(random_bytes(5));
			$md5 = md5($password);

                //check if account is unique
                if(count($this->Get->GetUser($mail)) == 1){

                    //not unique!!!
                    $data['feedback'] = 'Mailadres is reeds bekend.';

        			$this->load->view('template/header');
        			$this->load->view('add_user',$data);
                    $this->load->view('template/footer');

                }else{

    			//save to database
    			$this->Add->AddUser($name, $mail, $md5, $phone);

    			//send mail
    			$this->load->library('email', $mailconfig);
                $from = 'noreply@businessheuvelrug.nl';
                $url = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", base_url());
    			$this->email->from($from, 'Digiboard Businessclub de Heuvelrug');
    			$this->email->to($mail);
    			$this->email->subject('Uw account voor Digiboard Businessclub de Heuvelrug.');
            	$this->email->set_mailtype('html');

            	$message = "
                <html>
                <head>
                <style>
                body{
                padding: 10px;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 11pt;
                color: #575757;
                }

                .kop{
                color: #fff;
                background-color: #000;
                }

                .content{
                background-color: #fff;
                color: #000;
                }
                </style>
                </head>
                <body>
                <div class=\"kop\">
                <br />
                &nbsp;&nbsp;<img align=\"left\" src=\"data:image/png;base64,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\" width=\"200\" height=\"45\">
                <br /><br /><br />
                </div>
                <br />
                <table style=\"margin-left:40px;\">
                <tr>
                <td>
                <p>Beste $name,</p>
                <p>Er is een nieuw account aangemaakt voor de Digiboard applicatie van businessclub de Heuvelrug.
                Je wachtwoord is: <strong>$password</strong><br />Met dit wachtwoord kunt je inloggen op <strong>$url/admin</strong></p>
                </td>
                </tr>
                </table>
                </body>
                </html>";

    			$this->email->message($message);
    			$this->email->send();


                redirect('/users', 'refresh');

                }

			}

	}

	public function del_user()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $this->Del->DelUser($id);
			redirect('/users', 'refresh');

			}

	}

	public function sponsors()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['sponsors'] = $this->Get->GetSponsors();

			$this->load->view('template/header');
			$this->load->view('sponsors',$data);
            $this->load->view('template/footer');

			}

	}

	public function add_sponsor()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_sponsor');
            $this->load->view('template/footer');

			}

	}

	public function save_sponsor()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$name = $this->input->post('name');
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = $_FILES['file']['size'];

                if(($filesize < 256000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    $image = date('YmdHis').'.'.$extention;
                    move_uploaded_file($file, "./data/uploads/$image");

        			//save to database
        			$this->Add->AddSponsor($name, $image);

                    redirect('/sponsors', 'refresh');

                }else{

                $data['msg'] = 'invalid';

    			$this->load->view('template/header');
    			$this->load->view('add_sponsor', $data);
                $this->load->view('template/footer');

                }


			}

	}

	public function mod_sponsor()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $data['sponsor'] = $this->Get->GetSponsor($id);

			$this->load->view('template/header');
			$this->load->view('mod_sponsor',$data);
            $this->load->view('template/footer');

			}

	}

	public function update_sponsor()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
			$name = $this->input->post('name');
            $file = $_FILES['file']['tmp_name'];
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = $_FILES['file']['size'];

                if(($filesize < 256000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){
                    //remove old image first
                    $remove = $this->Get->GetSponsor($id);
                    foreach($remove as $remove){

                        unlink('./data/uploads/'.$remove->img);

                    }

                //upload new
                $image = date('YmdHis').'.'.$extention;
                move_uploaded_file($file, "./data/uploads/$image");
                $this->Add->ModSponsor($id, $name, $image);

                redirect('/sponsors', 'refresh');


                }elseif($filename == ''){
    			//save to database
    			$this->Add->ModSponsorNoImage($id, $name);

                redirect('/sponsors', 'refresh');

                }else{

                $data['msg'] = 'invalid';
                $data['sponsor'] = $this->Get->GetSponsor($id);

    			$this->load->view('template/header');
    			$this->load->view('mod_sponsor', $data);
                $this->load->view('template/footer');

                }


			}

	}

	public function del_sponsor()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $sponsor = $this->Get->GetSponsor($id);
                foreach($sponsor as $sponsor){

                unlink('./data/uploads/'.$sponsor->img.'');

                }

            $this->Del->DelSponsor($id);
			redirect('/sponsors', 'refresh');

			}

	}

	public function events()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['events'] = $this->Get->GetEvents();

			$this->load->view('template/header');
			$this->load->view('events',$data);
            $this->load->view('template/footer');

			}

	}

	public function add_event()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_event');
            $this->load->view('template/footer');

			}

	}

	public function save_event()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$title = $this->input->post('title');
			$date = $this->input->post('date');
            $content = $this->input->post('content');
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];

                if($filename == ''){
                $image = '';
    			//save to database
    			$this->Add->AddEvent($title, $date, $content, $image);
                redirect('/events', 'refresh');

                }else{

                $extention = pathinfo($filename, PATHINFO_EXTENSION);

                $filesize = $_FILES['file']['size'];

                if(($filesize < 512000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    $image = date('YmdHis').'.'.$extention;
                    move_uploaded_file($file, "./data/uploads/$image");

        			//save to database
        			$this->Add->AddEvent($title, $date, $content, $image);

                    redirect('/events', 'refresh');

                    }else{

                    $data['msg'] = 'invalid';

        			$this->load->view('template/header');
        			$this->load->view('add_event', $data);
                    $this->load->view('template/footer');

                    }
                }


			}

	}

	public function mod_event()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $data['event'] = $this->Get->GetEvent($id);

			$this->load->view('template/header');
			$this->load->view('mod_event',$data);
            $this->load->view('template/footer');

			}

	}

	public function update_event()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
			$title = $this->input->post('title');
			$date = $this->input->post('date');
            $content = $this->input->post('content');
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = $_FILES['file']['size'];

                if(($filesize < 512000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    //remove old image first
                    $remove = $this->Get->GetEvent($id);
                    foreach($remove as $remove){

                        unlink('./data/uploads/'.$remove->img);

                    }

                //upload new
                $image = date('YmdHis').'.'.$extention;
                move_uploaded_file($file, "./data/uploads/$image");
                $this->Add->ModEvent($id, $title, $date, $content, $image);

                redirect('/events', 'refresh');

                }elseif($filename == ''){
    			//save to database
    			$this->Add->ModEventNoImage($id, $title, $date, $content);

                redirect('/events', 'refresh');
                }else{

                $data['msg'] = 'invalid';
                $data['event'] = $this->Get->GetEvent($id);

    			$this->load->view('template/header');
    			$this->load->view('mod_event', $data);
                $this->load->view('template/footer');

                }

			}

	}

	public function del_event()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $event = $this->Get->GetEvent($id);
                foreach($event as $event){

                unlink('./data/uploads/'.$event->image.'');

                }

            $this->Del->DelEvent($id);
			redirect('/events', 'refresh');

			}

	}

	public function messages()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['messages'] = $this->Get->GetMessages();

			$this->load->view('template/header');
			$this->load->view('messages',$data);
            $this->load->view('template/footer');

			}

	}

	public function add_message()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_message');
            $this->load->view('template/footer');

			}

	}

	public function save_message()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$title = $this->input->post('title');
            $content = $this->input->post('content');
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];

                if($filename == ''){
                $image = '';
    			//save to database
    			$this->Add->AddMessage($title, $image, $content);
                redirect('/messages', 'refresh');

                }else{
                $extention = pathinfo($filename, PATHINFO_EXTENSION);
                 $filesize = $_FILES['file']['size'];

                    if(($filesize < 512000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    $image = date('YmdHis').'.'.$extention;
                    move_uploaded_file($file, "./data/uploads/$image");

        			//save to database
        			$this->Add->AddMessage($title, $image, $content);

                    redirect('/messages', 'refresh');

                    }else{

                    $data['msg'] = 'invalid';

        			$this->load->view('template/header');
        			$this->load->view('add_message', $data);
                    $this->load->view('template/footer');

                    }
                }
			}

	}

	public function mod_message()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $data['message'] = $this->Get->GetMessage($id);

			$this->load->view('template/header');
			$this->load->view('mod_message',$data);
            $this->load->view('template/footer');

			}

	}

	public function update_message()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
			$title = $this->input->post('title');
            $content = $this->input->post('content');
            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);

            $filesize = $_FILES['file']['size'];

                if(($filesize < 512000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    //remove old image first
                    $remove = $this->Get->GetMessage($id);
                    foreach($remove as $remove){

                        unlink('./data/uploads/'.$remove->img);

                    }

                //upload new
                $image = date('YmdHis').'.'.$extention;
                move_uploaded_file($file, "./data/uploads/$image");


    			//save to database
    			$this->Add->ModMessage($id, $title, $content, $image);

                redirect('/messages', 'refresh');


		    }elseif($filename == ''){
    			//save to database
    			$this->Add->ModMessageNoImage($id, $title, $content);

                redirect('/messages', 'refresh');

                }else{

                $data['msg'] = 'invalid';
                $data['message'] = $this->Get->GetMessage($id);

    			$this->load->view('template/header');
    			$this->load->view('mod_message', $data);
                $this->load->view('template/footer');

                }
            }

	}

	public function del_message()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $message = $this->Get->GetMessage($id);
                foreach($message as $message){

                unlink('./data/uploads/'.$message->image.'');

                }
            $this->Del->DelMessage($id);
			redirect('/messages', 'refresh');

			}

	}

	public function wallpapers()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $directory = './data/wallpapers';
            $wallpapers = array_diff(scandir($directory), array('..', '.'));

            $data['wallpapers'] = $wallpapers;

			$this->load->view('template/header');
			$this->load->view('wallpapers',$data);
            $this->load->view('template/footer');

			}

	}

	public function add_wallpaper()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_wallpaper');
            $this->load->view('template/footer');

			}

	}

	public function save_wallpaper()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $file = $_FILES['file']['tmp_name'];
            $filename = $_FILES['file']['name'];
            $extention = pathinfo($filename, PATHINFO_EXTENSION);
            $filesize = $_FILES['file']['size'];

                if(($filesize < 750000) and (($extention == 'jpg') or ($extention == 'JPG') or ($extention == 'jpeg') or ($extention == 'pngx') or ($extention == 'png') or ($extention == 'PNG')  or ($extention == 'gif'))){

                    $filename = strtolower(str_replace(' ','', $filename));
                    $filename = str_replace('(','',$filename);
                    $filename = str_replace(')','',$filename);
                    $filename = str_replace('-','',$filename);
                    $filename = str_replace('_','',$filename);

                    move_uploaded_file($file, "./data/wallpapers/$filename");

                    redirect('/wallpapers', 'refresh');

                }else{

                $data['msg'] = 'invalid';

    			$this->load->view('template/header');
    			$this->load->view('add_wallpaper', $data);
                $this->load->view('template/footer');

                }


			}

	}

	public function del_wallpaper()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $name = $this->uri->segment(3);
            $name_decode = base64_decode($name);
            $this->Del->DelSlidesWithWallpaper($name_decode);

            unlink('./data/wallpapers/'.$name_decode);
			redirect('/wallpapers', 'refresh');

			}

	}

	public function features()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $data['requests'] = $this->Get->GetRequests();

			$this->load->view('template/header');
			$this->load->view('requests',$data);
            $this->load->view('template/footer');

			}

	}

	public function add_request()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('add_request');
            $this->load->view('template/footer');

			}

	}

	public function save_request()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$title = $this->input->post('title');
            $content = $this->input->post('content');

            $this->Add->AddRequest($title, $content);

                $users = $this->Get->GetUsers();
                //send notification mail
                foreach($users as $user){

        			//send mail
        			$this->load->library('email', $mailconfig);
                    $from = 'noreply@businessheuvelrug.nl';
                    $url = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", base_url());
        			$this->email->from($from, 'Digiboard Businessclub de Heuvelrug');
        			$this->email->to($user->mail);
        			$this->email->subject('Nieuwe feature request voor de Digiboard app.');
                	$this->email->set_mailtype('html');

                	$message = "
                    <html>
                    <head>
                    <style>
                    body{
                    padding: 10px;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 11pt;
                    color: #575757;
                    }

                    .kop{
                    color: #fff;
                    background-color: #000;
                    }

                    .content{
                    background-color: #fff;
                    color: #000;
                    }
                    </style>
                    </head>
                    <body>
                    <div class=\"kop\">
                    <br />
                    &nbsp;&nbsp;<img align=\"left\" src=\"data:image/png;base64,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\" width=\"200\" height=\"45\">
                    <br /><br /><br />
                    </div>
                    <br />
                    <table style=\"margin-left:40px;\">
                    <tr>
                    <td>
                    <p>Beste $user->name,</p>
                    <p>Er is een nieuw feature request ingediend voor de digiboard applicatie. Het volgende verzoek is ingediend:<br /><br />
                    <strong>$title</strong>
                    <br /><br />
                    Zodra deze feature wordt bijgewerkt ontvang je via mail een update.
                    </p>

                    </td>
                    </tr>
                    </table>
                    </body>
                    </html>";

        			$this->email->message($message);
        			$this->email->send();

                }

            redirect('/features', 'refresh');

			}

	}

	public function mod_request()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
            $data['request'] = $this->Get->GetRequest($id);

			$this->load->view('template/header');
			$this->load->view('mod_request',$data);
            $this->load->view('template/footer');

			}

	}

	public function update_request()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

            $id = $this->uri->segment(3);
			$title = $this->input->post('title');
            $content = $this->input->post('content');
            $comment = $this->input->post('comment');
            $state = $this->input->post('state');

    			//save to database
    			$this->Add->UpdateRequest($id,$title,$content,$comment,$state);

                    if($state == 1){
                        $state = 'voltooid';
                    }elseif($state == 2){
                        $state = 'in behandeling';
                    }elseif($state == 3){
                        $state = 'afgewezen';
                    }elseif($state == 4){
                        $state = 'vraag';
                    }else{
                        $state = 'open';
                    }

                $users = $this->Get->GetUsers();
                //send notification mail
                foreach($users as $user){

        			//send mail
        			$this->load->library('email', $mailconfig);
                    $from = 'noreply@businessheuvelrug.nl';
                    $url = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", base_url());
        			$this->email->from($from, 'Digiboard Businessclub de Heuvelrug');
        			$this->email->to($user->mail);
        			$this->email->subject('Update op feature request voor de Digiboard app.');
                	$this->email->set_mailtype('html');

                	$message = "
                    <html>
                    <head>
                    <style>
                    body{
                    padding: 10px;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 11pt;
                    color: #575757;
                    }

                    .kop{
                    color: #fff;
                    background-color: #000;
                    }

                    .content{
                    background-color: #fff;
                    color: #000;
                    }
                    </style>
                    </head>
                    <body>
                    <div class=\"kop\">
                    <br />
                    &nbsp;&nbsp;<img align=\"left\" src=\"data:image/png;base64,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\" width=\"200\" height=\"45\">
                    <br /><br /><br />
                    </div>
                    <br />
                    <table style=\"margin-left:40px;\">
                    <tr>
                    <td>
                    <p>Beste $user->name,</p>
                    <p>Er is een update op een feature request voor de digiboard applicatie. Het volgende verzoek is bijgewerkt:<br /><br />
                    <strong>$state: $title</strong>
                    <br /><br />
                    Kijk op https://digiboard.businessheuvelrug.nl/admin, feature requests voor meer informatie.
                    </p>

                    </td>
                    </tr>
                    </table>
                    </body>
                    </html>";

        			$this->email->message($message);
        			$this->email->send();

                }

                redirect('/features', 'refresh');


			}

	}

	public function toggle_slide()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

                $id = $this->uri->segment(3);
                $active = $this->uri->segment(4);

    			//save to database
    			$this->Add->SlideState($id,$active);

                redirect('/admin', 'refresh');


			}

	}

	public function info()
    {

		$user = $this->session->user;
		$pass = $this->session->pass;

			$count = count($this->Get->CheckAccount($user,$pass));

			if(($count == 0)){

            redirect('/quit', 'refresh');

			}else{

			$this->load->view('template/header');
			$this->load->view('info');
            $this->load->view('template/footer');

			}

	}

	public function quit()
    {

		//destroy login session
		$this->session->sess_destroy();

			//back to login
			redirect('/login', 'refresh');

	}


}
