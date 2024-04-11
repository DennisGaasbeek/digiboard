<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-heart"></span> Sponsors.
                <div class="pull-right"><a href="/add_sponsor"><span class="badge"><span class="glyphicon glyphicon-plus"></span> sponsor toevoegen</span></a></div>
            </div>
            <div class="panel-body">
            <div class="alert alert-info" role="alert">
            Beheer hier de sponsor referenties. Sponsors kun je vervolgens aan slides koppelen.
            </div>

            <?php

            if(count($sponsors) == 0){

            echo 'Geen data.';

            }else{

            echo '
            <table class="table borderless">
                <thead class="thead_border">
                    <th></th>
                    <th class="col-md-11">Naam:</th>
                    <th class="col-md-1">Opties:</th>
                </thead>
                <tbody>';

                foreach($sponsors as $sponsor){

                echo '
                <tr>
                    <td>
                        <div id="preview">
                            <a style="color: #000 !important;" data-toggle="tooltip" title="<img style=\'max-width: 150px; max-height: 150px;\' src=\'./data/uploads/'.$sponsor->img.'\' />"><span class="glyphicon glyphicon-picture"></span></a>
                        </div>
                    </td>
                    <td>'.$sponsor->name.'</td>
                    <td>
                        <a onClick="return confirm(\'Sponsor '.$sponsor->name.' permanent verwijderen?\')" href="Main/del_sponsor/'.$sponsor->id.'/"><span class="label label-danger">Verwijder</a></span>
                        <a href="Main/mod_sponsor/'.$sponsor->id.'/"><span class="label label-warning">Bewerk</a></span>
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



