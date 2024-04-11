<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-calendar"></span> Evenementen.
                <div class="pull-right"><a href="/add_event"><span class="badge"><span class="glyphicon glyphicon-plus"></span> evenement toevoegen</span></a></div>
            </div>
            <div class="panel-body">
            <div class="alert alert-warning" role="alert">
            Beheer hier de evenementen. Evenementen kun je vervolgens aan slides koppelen.<br />
            Het is niet mogelijk om de afbeelding te wijzigen, hiervoor dient het evenement opnieuw toegevoegd te worden. <strong>Update dan ook de slides!</strong>
            </div>

            <?php

            if(count($events) == 0){

            echo 'Geen data.';

            }else{

            echo '
            <table class="table borderless">
                <thead class="thead_border">
                    <th class="col-md-1">Datum:</th>
                    <th class="col-md-1">Verlopen:</th>
                    <th class="col-md-7">Titel:</th>
                    <th class="col-md-1">Afbeelding:</th>
                    <th class="col-md-2">Opties:</th>
                </thead>
                <tbody>';

                foreach($events as $event){

                echo '
                <tr>
                    <td>'.date("d-m-Y", strtotime($event->date)).'</td>
                    <td>';

                    if($event->date < date('Y-m-d')){
                        echo 'ja';
                    }else{
                        echo 'nee';
                    }

                    echo '
                    </td>
                    <td>'.$event->title.'</td>
                    <td>
                        <div id="preview">
                            <a style="color: #000 !important;" data-toggle="tooltip" title="<img style=\'max-width: 150px; max-height: 150px;\' src=\'./data/uploads/'.$event->image.'\' />"><span class="glyphicon glyphicon-picture"></span></a>
                        </div>
                    </td>
                    <td>
                        <a onClick="return confirm(\'Evenement '.$event->title.' permanent verwijderen?\')" href="Main/del_event/'.$event->id.'/"><span class="label label-danger">Verwijder</a></span>
                        <a href="Main/mod_event/'.$event->id.'/"><span class="label label-warning">Bewerk</a></span>
                    </td>
                </tr>';

                }

                echo '
                </tbody>
            </table>';

            }

            ?>
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

