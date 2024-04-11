<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-duplicate"></span> Slides.

                <?php
                if(count($slides) < 20){

                echo '
                <div class="pull-right">
                <a href="/add_slide"><span class="badge"><span class="glyphicon glyphicon-plus"></span> slide toevoegen</span></a>
                <a href="/add_videoslide"><span class="badge"><span class="glyphicon glyphicon-plus"></span> videoslide toevoegen</span></a>
                </div>';

                }

                ?>

            </div>
            <div class="panel-body">
            <div class="alert alert-info" role="alert">
            Beheer hier de slides die worden weergegeven op de beeldschermen. Er zijn maximaal 20 slides mogelijk.
            </div>

            <?php

            if(count($slides) == 0){

            echo 'Geen data.';

            }else{

            $count = count($slides);

            echo form_open('save_order');

            echo '
            <table class="table borderless">
                <thead class="thead_border">
                    <th class="col-md-1">Positie:</th>
                    <th class="col-md-2">Beschrijving:</th>
                    <th class="col-md-2">Titel:</th>
                    <th class="col-md-1">Afbeelding:</th>
                    <th class="col-md-1">Wallpaper:</th>
                    <th class="col-md-1">Actief:</th>
                    <th class="col-md-1">Laatste run:</th>
                    <th class="col-md-1">Duur:</th>
                    <th class="col-md-2">Opties:</th>
                </thead>
                <tbody>';

                $loop = 0;
                foreach($slides as $slide){

                echo '
                <tr>
                    <td>';

        				$order = array(
                            '1.'.$slide->id.'' => '1',
                            '2.'.$slide->id.'' => '2',
                            '3.'.$slide->id.'' => '3',
                            '4.'.$slide->id.'' => '4',
                            '5.'.$slide->id.'' => '5',
                            '6.'.$slide->id.'' => '6',
                            '7.'.$slide->id.'' => '7',
                            '8.'.$slide->id.'' => '8',
                            '9.'.$slide->id.'' => '9',
                            '10.'.$slide->id.'' => '10',
                            '11.'.$slide->id.'' => '11',
                            '12.'.$slide->id.'' => '12',
                            '13.'.$slide->id.'' => '13',
                            '14.'.$slide->id.'' => '14',
                            '15.'.$slide->id.'' => '15',
                            '16.'.$slide->id.'' => '16',
                            '17.'.$slide->id.'' => '17',
                            '18.'.$slide->id.'' => '18',
                            '19.'.$slide->id.'' => '19',
                            '20.'.$slide->id.'' => '20',
                        );

                    $order = form_dropdown('order[]', $order, $slide->order.'.'.$slide->id, 'class="form-control input_1"');

                    echo $order;

                    echo '
                    </td>
                    <td>'.$slide->discription.'</td>
                    <td>';

                    if($slide->title == ''){
                        echo '...';
                    }else{
                        echo $slide->title;
                    }

                    echo '
                    </td>
                    <td>';

                    if($slide->image != ''){

                        echo '
                        <div id="preview">
                            <a style="color: #000 !important;" data-toggle="tooltip" title="<img style=\'max-width: 150px; max-height: 150px;\' src=\'./data/uploads/'.$slide->image.'\' />"><span class="glyphicon glyphicon-picture"></span></a>
                        </div>';
                    }else{

                    echo '...';

                    }

                    echo '
                    </td>
                    <td>
                        <div id="preview">
                            <a style="color: #000 !important;" data-toggle="tooltip" title="<img style=\'max-width: 150px; max-height: 150px;\' src=\'./data/wallpapers/'.$slide->wallpaper.'\' />"><span class="glyphicon glyphicon-picture"></span></a>
                        </div>
                    </td>
                    <td>';

                    if($slide->active == '0'){
                        echo 'nee';
                    }else{
                        echo 'ja';
                    }

                    echo '
                    </td>
                    <td>';

                    if($slide->ran_last == '0000-00-00 00:00:00'){
                        echo 'nooit';
                    }else{
                        echo date("d-m-Y H:i:s", strtotime($slide->ran_last));
                    }

                    if($slide->duration != '10'){

                    $duration = $slide->duration - 15;

                    }else{

                    $duration = 'test';

                    }

                    echo '
                    </td>
                    <td>'.$duration.' sec.</td>
                    <td>';

                        if($slide->active == '1'){
                            echo '<a href="Main/toggle_slide/'.$slide->id.'/0/"><span class="label label-default">Deactiveer</a></span>';
                        }else{
                            echo '<a href="Main/toggle_slide/'.$slide->id.'/1/"><span class="label label-success">Activeer</a></span>';
                        }

                        if((strpos($slide->content, 'youtu.be') !== false) or (strpos($slide->content, 'youtube.com') !== false)){

                        echo '
                        <a href="Main/mod_videoslide/'.$slide->id.'/"><span class="label label-warning">Bewerk</a></span>';

                        }else{

                        echo '
                        <a href="Main/mod_slide/'.$slide->id.'/"><span class="label label-warning">Bewerk</a></span>';

                        }

                        echo '
                        <a onClick="return confirm(\'Slide permanent verwijderen?\')" href="Main/del_slide/'.$slide->id.'/"><span class="label label-danger">Verwijder</a></span>
                    </td>
                </tr>';

                $loop++;

                }

                echo '
                </tbody>
            </table>';

            }

            ?>

                <div class="row">
                    <hr />
                    <div class="col-md-1">
                    <?php echo form_submit('submit', 'volgorde opslaan', 'class="btn btn-submit btn-default"'); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>

        </div>
    </div>
</div>
<script>
$('#preview [data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'right',
    html: true
});
</script>