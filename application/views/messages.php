<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-comment"></span> Berichten.
                <div class="pull-right"><a href="/add_message"><span class="badge"><span class="glyphicon glyphicon-plus"></span> bericht toevoegen</span></a></div>
            </div>
            <div class="panel-body">
            <div class="alert alert-warning" role="alert">
            Beheer hier de berichten. Berichten kun je vervolgens aan slides koppelen.<br />
            Het is niet mogelijk om de afbeelding te wijzigen, hiervoor dient het evenement opnieuw toegevoegd te worden. <strong>Update dan ook de slides!</strong>
            </div>

            <?php

            if(count($messages) == 0){

            echo 'Geen data.';

            }else{

            echo '
            <table class="table borderless">
                <thead class="thead_border">
                    <th class="col-md-9">Titel:</th>
                    <th class="col-md-1">Icon:</th>
                    <th class="col-md-2">Opties:</th>
                </thead>
                <tbody>';

                foreach($messages as $message){

                echo '
                <tr>
                    <td>'.$message->title.'</td>
                    <td>
                        <div id="preview">
                            <a style="color: #000 !important;" data-toggle="tooltip" title="<img style=\'max-width: 32px; max-height: 32px;\' src=\'./data/uploads/'.$message->image.'\' />"><span class="glyphicon glyphicon-picture"></span></a>
                        </div>
                    </td>
                    <td>
                        <a onClick="return confirm(\'Bericht '.$message->title.' permanent verwijderen?\')" href="Main/del_message/'.$message->id.'/"><span class="label label-danger">Verwijder</a></span>
                        <a href="Main/mod_message/'.$message->id.'/"><span class="label label-warning">Bewerk</a></span>
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


