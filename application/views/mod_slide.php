<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-duplicate"></span> Slide bewerken.
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                        Als er geen titel, afbeelding of text wordt opgegeven in het vrije veld, dan krijg je een slide met achtergrond, maar zonder vrije tekst.
                        Wel kun je evenementen, berichten of sponsoren weergeven. Dit geeft je meer artisitieke vrijheid.
                        </div>
                    </div>
                </div>

                <?php

                if($msg == 'invalid'){

                echo '
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-danger no_radius" role="alert">Het opgegeven bestand lijkt geen afbeelding te zijn of het bestand is te groot (750KB)!</div>
                    </div>
                </div>';

                }

                foreach($slide as $slide){ }

                echo form_open_multipart('/Main/update_slide/'.$slide->id.'/');

                $discription = array('name' => 'discription', 'maxlength' => '150','required' => 'required', 'class' => 'form-control input_1', 'value' => $slide->discription);
                $title = array('name' => 'title', 'maxlength' => '50', 'class' => 'form-control input_1', 'value' => $slide->title);
                $content = array('name' => 'content','maxlength' => '400', 'class' => 'form-control input_1', 'value' => $slide->content, 'id' => 'countdown');

    				$active = array(
    					'1' => 'ja, deze slide publiceren na opslaan',
    					'0' => 'nee, alleen opslaan',
                    );

                $active = form_dropdown('active', $active, $slide->active, 'class="form-control input_1"');

    				$font = array(
    					'black' => 'zwart',
    					'white' => 'wit',
                    );

                $font = form_dropdown('font', $font, $slide->fontcolor, 'class="form-control input_1"');

                    $slide->duration = $slide->duration - 15;
    				$delay = array(
                        '10' => '10 seconden',
                        '30' => '30 seconden',
                        '60' => '1 minuut',
                        '180' => '3 minuten',
                        '300' => '5 minuten',
                        '600' => '10 minuten',
                        '900' => '15 minuten',
                        '5' => 'testmodus',
                    );

                $delay = form_dropdown('delay', $delay, $slide->duration, 'class="form-control input_1"');

                $directory = './data/wallpapers';
                $wallpapers = array_diff(scandir($directory), array('..', '.'));

                ?>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <label>Slide beschrijving</label>
                        <?php echo form_input($discription); ?>
                    </div>

                    <div class="col-md-2">
                        <label>Titel</label>
                        <?php echo form_input($title); ?>
                    </div>

                    <div class="col-md-2">
                        <label>Afbeelding (.png/.jpg/.jpeg) (max. 750KB)</label>
                        <input type="file" name="file">
                    </div>

                    <div class="col-md-2">
                        <label>Publiceren</label>
                        <?php echo $active; ?>
                    </div>

                    <div class="col-md-2">
                        <label>Wallpaper</label>
                        <select name="wallpaper" class="form-control input_1">
                        <?php

                        echo '<option value="'.$slide->wallpaper.'">'.$slide->wallpaper.'</option>';

                        foreach($wallpapers as $wallpaper){

                            if($wallpaper != $slide->wallpaper){

                            echo '<option value="'.$wallpaper.'">'.$wallpaper.'</option>';

                            }

                        }


                        ?>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label>Kleur lettertype</label>
                        <?php echo $font; ?>
                    </div>

                    <div class="col-md-1">
                        <label>Duratie</label>
                        <?php echo $delay; ?>
                    </div>

                    <div class="col-md-8">
                        <br />
                        <label>Vrij veld - <span id="characters-counter">400</span> tekens resterend</label>
                        <?php echo form_textarea($content); ?>
                    </div>

                    <div class="col-md-4">
                        <br />
                        <label>Welke content wil je ook laten zien op de slide?</label>
                        <table class="table borderless">
                        <thead class="thead_border">
                            <th></th>
                            <th class="col-md-2">Type</th>
                            <th class="col-md-10">Item</th>
                        </thead>
                        <tbody>

                        <?php

                        $eventlist = explode(',',$slide->calendar);
                        foreach($events as $event){
                            if(in_array($event->id, $eventlist)){

                                echo '
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="chk[]" value="e&'.$event->id.'" checked></td>
                                    <td>Evenement</td>
                                    <td>'.$event->title.'</td>
                                </tr>';

                            }else{

                                echo '
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="chk[]" value="e&'.$event->id.'"></td>
                                    <td>Evenement</td>
                                    <td>'.$event->title.'</td>
                                </tr>';

                            }

                        }

                        $messagelist = explode(',',$slide->messages);
                        foreach($messages as $message){

                            if(in_array($message->id, $messagelist)){

                                echo '
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="chk[]" value="m&'.$message->id.'" checked></td>
                                    <td>Bericht</td>
                                    <td>'.$message->title.'</td>
                                </tr>';

                            }else{

                                echo '
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="chk[]" value="m&'.$message->id.'"></td>
                                    <td>Bericht</td>
                                    <td>'.$message->title.'</td>
                                </tr>';
                            }

                        }

                        $sponsorlist = explode(',',$slide->sponsors);
                        foreach($sponsors as $sponsor){

                            if(in_array($sponsor->id, $sponsorlist)){

                                echo '
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="chk[]" value="s&'.$sponsor->id.'" checked></td>
                                    <td>Sponsor</td>
                                    <td>'.$sponsor->name.'</td>
                                </tr>';

                            }else{

                                echo '
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="chk[]" value="s&'.$sponsor->id.'"></td>
                                    <td>Sponsor</td>
                                    <td>'.$sponsor->name.'</td>
                                </tr>';


                            }

                        }


                        ?>

                        </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <br />
                    <div class="col-md-1">
                    <?php echo form_submit('submit', 'aanpassen', 'class="btn btn-submit btn-default"'); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
        var maxCharacters = 400;
        document.getElementById('countdown').onkeyup = function() {
            document.getElementById('characters-counter').innerHTML = (maxCharacters - this.value.length);
        };
});
</script>