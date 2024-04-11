<?php

foreach($settings as $setting){}
$day = date('w');
$time = date('Hi');

if(($setting->teletekst == 1) and ($day == 6) and ($time > '1615') and $time < '1645'){

echo '<meta http-equiv="refresh" content="180">';

echo'
<style>
.main {
background: url(/data/img/teletekst.jpg) no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
height: 100vh !important;
}

.stand {
position: absolute;
top: 175px;
left: 135px;
font-size: 20px;
color: #fffa0c;
width: 700px;
}

.stand_title {
position: absolute;
top: 110px;
left: 250px;
font-size: 25px;
color: #fffa0c;
font-weight: bold;
}

.live {
position: absolute;
top: 175px;
left: 1085px;
font-size: 20px;
color: #fffa0c;
}

.live_title {
position: absolute;
top: 110px;
left: 1200px;
font-size: 25px;
color: #fffa0c;
font-weight: bold;
}

.legend {
position: absolute;
top: 230px;
left: 630px;
font-size: 21px;
color: #fffa0c;
border-bottom: 3px solid #fffa0c;
}

.green {
color: #11f313;
font-size: 25px;
}

.yellow {
color: #fffa0c !important;
font-size: 25px;
}
</style>';

echo '<div class="main full_height">';
echo '
<div class="stand_title">
Stand competitie
</div>

<div class="legend">
G &bullet; W &bullet; G &bullet; V &bullet; P &bullet; V-T
</div>

<div class="stand">';

    $content = file_get_contents('https://teletekst-data.nos.nl/webtekst?p='.$setting->teletekst_pagina.'-2');
    $content = explode("<pre id=\"content\">" , $content);
    $content = explode("</pre>" , $content[1]);
    $content = explode("2/2" , $content[0]);
    $content = explode("<span class=\"red\">", $content[1]);
    $array = explode(PHP_EOL, $content[0]);

    $content = nl2br($content[0]);
    $content = str_replace('</span><span class="green">', '</span><span class="green pull-right">', $content);
    $content = str_replace('<span class="green">', '<span class="green" style="width: 40px; display: inline-block; !important;">', $content);
    $content = str_replace('<span class="green" style="width: 40px; display: inline-block; !important;">     + periodekampioen                  </span><br />', '', $content);
    $content = explode('<span class="green pull-right"> +      </span>', $content);
    $content = str_replace('</span><span class="green">', '</span><span class="green pull-right">', $content);
    $content = str_replace('+', '', $content);

    $content_complete = $content[0].$content[1];


    $content = explode('<span class="green pull-right">', $content_complete);

    foreach($content as $con){

    echo '<span class="green pull-right">'.$con.'</span>';

    }


echo '
</div>

<div class="live_title">
Uitslagen / tussenstanden
</div>

<div class="live">';

    $content = file_get_contents('https://teletekst-data.nos.nl/webtekst?p='.$setting->teletekst_pagina.'');
    $content = explode("<pre id=\"content\">" , $content);
    $content = explode("</pre>" , $content[1]);
    $content = explode("<span class=\"red\">", $content[0]);
    $content = explode("1/2" , $content[1]);
    $content = nl2br($content[1]);

    echo $content;

echo '
</div>';


echo '</div>';

}else{

if(count($slides) == 0){

echo '<meta http-equiv="refresh" content="10">';

}

if(count($slides) > 0){

    foreach($slides as $slide){

    //mark as last slide that ran
    $this->Add->MarkasShown($slide->id);
    echo '<meta http-equiv="refresh" content="'.$slide->duration.'">';

    echo'
    <style>
    .main {
    background: url(/data/wallpapers/'.$slide->wallpaper.') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100vh !important;
    }

    .progress_bar {
    margin: auto;
    width: 100%;
    height: 5px;
    position: relative;
    overflow: hidden;
    }
    .progress_bar:before {
    content: \'\';
    width: 200%;
    height: 100%;
    position: absolute;
    animation: progress-anime '.$slide->duration.'s ease infinite;
    background: linear-gradient(to right, #000 0%, #000 25%, #dc3545 50%,#d2d2d2 50%,#d2d2d2 100%);
    }

    @keyframes progress-anime {
        0% {left: -100%;}
        75% {left: -25%;}
        85% {left: -15%;}
        95% {left: -5%;}
    }

    </style>';

    }

}

?>
<div class="row" id="fade">
<div class="col-md-12">

<?php

if(count($slides) == 0){

    echo'
    <br />
    <div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-body">
            Geen actieve slides, maak nieuwe slides aan in de admin module.
            </div>
		</div>
	</div>';

}else{

    foreach($slides as $slide){

    if((strpos($slide->content, 'youtu.be') !== false) or (strpos($slide->content, 'youtube.com') !== false)){

    $youtube = end(explode('/', $slide->content));

        echo '
        <div class="main full_height">
        <div class="progress_bar"></div>

            <div class="youtube">
            <iframe
            width="1688"
            height="950"
            allow="autoplay"
            src="https://www.youtube.com/embed/'.$youtube.'?autoplay=1&mute=1&enablejsapi=0&rel=0&start=1"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer;
            autoplay; clipboard-write;
            encrypted-media;
            web-share">
            </iframe>

            </div>
        </div>';

    }else{

    echo '
    <div class="main full_height">
    <div class="progress_bar"></div>';

        if($slide->sponsors != ''){

        echo '
        <div class="col-md-2">';

                if($slide->fontcolor == 'white'){
                    echo '<div class="panel-body white">';
                }else{
                    echo '<div class="panel-body black">';
                }

                    $arr = explode(',',$slide->sponsors);
                    shuffle($arr);

                    echo '
                    <div class="col-md-12 boxes_font">
                        <div class="sponsors">
                            <div>';

                            foreach($arr as $id){
                                $sponsors = $this->Get->GetSponsor($id);
                                foreach($sponsors as $sponsor){

                                echo '<div class="sponsor_box"><img class="logo" src="./data/uploads/'.$sponsor->img.'"></div>';

                                }
                            }

                        echo '
                            </div>
                        </div>
                    </div>
            </div>
        </div>';

        }

        if(($slide->title != '') and ($slide->content != '') and ($slide->image != '')){

        if($slide->calendar == ''){ $div_cal = '0'; }else{ $div_cal = '1'; }
        if($slide->messages == ''){ $div_msg = '0'; }else{ $div_cal = '1'; }
        if(date('w') == '6'){ $div_ls = '1'; }else{ $div_ls = '1'; }


        $both_empty = $div_cal + $div_msg + $div_ls;

        if(($slide->sponsors != '') and ($both_empty == 0)){
            echo '<div class="col-md-9">';
        }elseif(($slide->sponsors == '') and ($both_empty > 0)){
            echo '<div class="col-md-9">';
        }else{
            echo '<div class="col-md-7">';
        }

        echo'
            <div class="boxes_font">
                <img class="main_img" src="/data/uploads/'.$slide->image.'">
                <div class="title_box alert-success">'.$slide->title.'</div>';

                if($slide->fontcolor == 'white'){
                    echo '<div class="main_tekst white">';
                }else{
                    echo '<div class="main_tekst black">';
                }

                    echo nl2br($slide->content);

                echo '
                </div>
            </div>
    	</div>';

        }

        echo '
        <div class="col-md-3 level pull-right">';

            if($slide->calendar != ''){
            echo '
            <div class="col-md-12">
        		<div class="panel panel-default opac_sidebar">';

                    if($slide->fontcolor == 'white'){
                        echo '<div class="panel-body white">';
                    }else{
                        echo '<div class="panel-body black">';
                    }

                        $arr = explode(',',$slide->calendar);

                        echo '
                        <div class="col-md-12 boxes_font">
                            <div class="events">';

                            foreach($arr as $id){

                                $event = $this->Get->GetEvent($id);
                                foreach($event as $event){

                                echo '
                                <div>
                                <img class="event_img" src="/data/uploads/'.$event->image.'">';

                                if($slide->fontcolor == 'white'){
                                    echo '<h4 class="white">'.$event->title.'</h4>';
                                }else{
                                    echo '<h4 class="black">'.$event->title.'</h4>';
                                }

                                echo '<div class="alert alert-success">Aanvang: '.date("d-m-Y", strtotime($event->date)).'</div>';

                                echo $event->content;

                                echo '
                                </div>';

                                }


                            }

                        echo '</div>
                        </div>
                    </div>
                </div>
            </div>';

            }

            if($slide->messages != ''){
            echo '
            <div class="col-md-12">
        		<div class="panel panel-default opac_sidebar">';

                    if($slide->fontcolor == 'white'){
                        echo '<div class="panel-body white">';
                    }else{
                        echo '<div class="panel-body black">';
                    }

                    $arr = explode(',',$slide->messages);

                    echo '
                    <div class="col-md-12 boxes_font">
                        <div class="messages">';

                        foreach($arr as $id){

                            $message = $this->Get->GetMessage($id);
                            foreach($message as $message){

                                if($slide->fontcolor == 'white'){
                                    echo '<div><h4 class="white">';
                                }else{
                                    echo '<div><h4 class="black">';
                                }

                            echo $message->title.'</h4>
                            <div class="col-md-2" style="min-height: 140px;"><img class="small_img pull-left" src="./data/uploads/'.$message->image.'"></div>
                            '.$message->content.'</div>';

                            }

                        }

                        echo '
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }

        echo '
        </div>
    </div>';

        }

    }

}

}

?>

    </div>
</div>

<script>
$('.events').bxSlider({
    auto: true,
    controls: false,
    autoControls: false,
    stopAutoOnClick: false,
    pager: false,
    mode: 'fade',
    speed: 1000,
    pause: 10000,
    infiniteLoop: true,
    responsive: false

});
</script>
<script>
$('.messages').bxSlider({
    auto: true,
    controls: false,
    autoControls: false,
    stopAutoOnClick: false,
    pager: false,
    infiniteLoop: true,
    speed: 1000,
    pause: 10000,

});
</script>

<script>

$('.sponsors').easyTicker({
    auto: true,
    direction: 'up',
    ticker: true,
    controls: false,
    autoControls: false,
    stopAutoOnClick: false,
    pager: false,
    easing: 'swing',
    speed: 1000,
    pause: 2000,
    infiniteLoop: true,
    responsive: false

});
</script>

<script>
$('#tick2').html($('#tick').html());
//alert($('#tick2').offset.left);

var temp=0,intervalId=0;
$('#tick li').each(function(){
  var offset=$(this).offset();
  var offsetLeft=offset.left;
  $(this).css({'left':offsetLeft+temp});
  temp=$(this).width()+temp+10;
});
$('#tick').css({'width':temp+40, 'margin-left':'20px'});
temp=0;
$('#tick2 li').each(function(){
  var offset=$(this).offset();
  var offsetLeft=offset.left;
  $(this).css({'left':offsetLeft+temp});
  temp=$(this).width()+temp+10;
});
$('#tick2').css({'width':temp+40,'margin-left':temp+40});

function abc(a,b) {

    var marginLefta=(parseInt($("#"+a).css('marginLeft')));
    var marginLeftb=(parseInt($("#"+b).css('marginLeft')));
    if((-marginLefta<=$("#"+a).width())&&(-marginLefta<=$("#"+a).width())){
        $("#"+a).css({'margin-left':(marginLefta-1)+'px'});
    } else {
        $("#"+a).css({'margin-left':temp});
    }
    if((-marginLeftb<=$("#"+b).width())){
        $("#"+b).css({'margin-left':(marginLeftb-1)+'px'});
    } else {
        $("#"+b).css({'margin-left':temp});
    }
}

     function start() { intervalId = window.setInterval(function() { abc('tick','tick2'); }, 50) }

     $(function(){
          $('#outer').mouseenter(function() { window.clearInterval(intervalId); });
    $('#outer').mouseleave(function() { start(); })
          start();
     });
</script>

<script>
$("#fade").hide(0).delay(0).fadeIn(2000)
</script>

