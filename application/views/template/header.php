<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    
?>

<!DOCTYPE html>
<html>
<head>
	<?php header("Cache-Control: public, max-age=0, s-maxage=0");?>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
    
    <link href="/data/css/bootstrap.css" rel="stylesheet">
    <link href="/data/css/custom.css" rel="stylesheet">
    <link href="/data/css/slider.css" rel="stylesheet">

	<title><?php echo $web_title ?></title>

    <link rel="icon" href="/data/img/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/data/img/favicon.png" />

	<script src="/data/js/jquery-3.1.1.min.js"></script>
    <script src="/data/js/bootstrap.min.js"></script>
    <script src="/data/js/jquery.bxslider.js"></script>
    <script src="/data/js/ticker.js"></script>

    <?php

    $subpage = $this->uri->segment(1);

    if($subpage == ''){

    echo '
    <style>
    body {
    overflow-y: hidden !important;
    overflow-x: hidden !important;
    background: url(/data/img/darktouch.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100vh !important;
    font-size: 50px !important;
    }

    h4 {
    font-size: 20px; !important;
    color: #fff; !important;
    font-family: Arial !important;
    font-weight: 900;
    }

    .boxes_font {
    font-size: 22px; !important;
    font-family: Arial !important;
    }

    .white {
    color: #fff !important;
    }

    .black {
    color: #000 !important;
    }

    h3 {
    font-size: 30px; !important;
    color: #000; !important;
    font-family: Arial !important;
    font-weight: 900;
    }

    .main_img {
    object-fit: cover !important;
    width: 100%;
    height: 420px;
    margin-top: 50px;
    z-index: 9990;
    border-bottom: 4px solid #fff;
    border-radius: 5px;
    transform: auto;
    }

    .event_img {
    object-fit: cover !important;
    width: 100%;
    height: 200px;
    z-index: 9990;
    border-radius: 5px;
    border-bottom: 3px solid #fff;
    }

    .small_img {
    max-width: 50px !important;
    max-height: 70px !important;
    z-index: 9990;
    border-right: 2px solid #fff;
    padding-right: 5px;
    margin-left: -15px;
    margin-top: 5px;
    }

    .alert {
    font-size: 20px !important;
    color: #fff !important;
    font-weight: 900;
    padding: 10px !important;
    background-color: #ff0000 !important;
    border-radius: 0px;
    border: 0px;
    max-width: 300px;
    border-left: 3px solid #fff;
    border-radius: 5px;
    }

    .main_tekst {
    font-size: 30px !important;
    width: 90%;
    }

    .title_box {
    font-size: 40px !important;
    color: #fff !important;
    font-weight: 900;
    padding-left: 10px !important;
    padding-right: 10px !important;
    background-color: #ff0000 !important;
    border-radius: 0px;
    border: 0px;
    max-width: 750px;
    z-index: 9999;
    position: relative;
    top: -40px;
    border-top: 5px solid #fff;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border-top-right-radius: 5px;
    }

    .opac_sidebar {
    background: rgba(255, 255, 255, .3) !important;
    color: #000;
    backdrop-filter: blur(5px);
    border: 0px;
    border-radius: 0px;
    border-radius: 5px;
    }

    .level {
    margin-top: 50px;
    }

    .sponsors {
    margin-top: 13px;
    }

    .sponsor_box {
    background-color: #fff;
    width: 100%;
    height: 170px;
    border-radius: 5px;
    margin-top: 20px !important;
    margin-bottom: 20px !important;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .youtube {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 80px;
    }

    .logo {
    width: 100%;
    max-height: 130px;
    border: 2px solid #fff;
    border-radius: 5px;
    background-color: #fff;
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 3px;
    }

    </style>';
    }
    ?>

</head>
<body>

<?php

$user = $this->session->user;
$pass = $this->session->pass;
$today = date('Y-m-d');

$check1 = count($this->Get->CheckAccount($user,$pass));
$check2 = count($this->Get->CheckDateAccount($user,$pass,$today));


if(($check1 == 1)){

    if($check2 == 0){
    //time to login again, preview login equals different date
        redirect('/quit', 'refresh'); 
    }

    $subpage = $this->uri->segment(1);

    if($subpage != ''){
    echo'
    <div class="col-md-12">
        <div class="pull-right">
            <br />
            <ol class="breadcrumb">
                <li><a onClick="return confirm(\'De navigatie is niet beschikbaar in de kiosk weergave. \r\r- Klik op de browser terugknop om terug te gaan.\r- Klik op F5 om door de slides heen te navigeren.\r- Klik op F11 voor full-screen modus.\')" href="/"><span class="glyphicon glyphicon-eye-open"></span> Kiosk weergave</a></li>
                <li><a href="/admin"><span class="glyphicon glyphicon-duplicate"></span> Slides</a></li>
                <li><a href="/sponsors"><span class="glyphicon glyphicon-heart"></span> Sponsors</a></li>
                <li><a href="/events"><span class="glyphicon glyphicon-calendar"></span> Evenementen</a></li>
                <li><a href="/messages"><span class="glyphicon glyphicon-comment"></span> Berichten</a></li>
                <li><a href="/wallpapers"><span class="glyphicon glyphicon-picture"></span> Wallpapers</a></li>
                <li><a href="/users"><span class="glyphicon glyphicon-user"></span> Accounts</a></li>
                <li><a href="/features"><span class="glyphicon glyphicon-bullhorn"></span> Feature requests</a></li>
                <li><a href="/info"><span class="glyphicon glyphicon-info-sign"></span> HWinfo</a></li>
                <li><a href="/settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                <li><a onClick="return confirm(\'Wilt u echt afmelden?\')" href="/quit"><span class="glyphicon glyphicon-off"></span> Afmelden</a></li>
            </ol>
        </div>
    </div>';
    }


}

?>

