<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-bullhorn"></span> Feature requests
                <div class="pull-right"><a href="/add_request"><span class="badge"><span class="glyphicon glyphicon-plus"></span> feature request indienen</span></a></div>
            </div>
            <div class="panel-body">
            <div class="alert alert-info" role="alert">
            Bug gevonden of nieuwe functionaliteit nodig? Hiervoor kun je een feature request indienen.
            </div>

            <?php

            if(count($requests) == 0){

            echo 'Geen data.';

            }else{

            echo '
            <table class="table borderless">
                <thead class="thead_border">
                    <th class="col-md-1">Status</th>
                    <th class="col-md-10">Verzoek:</th>
                    <th class="col-md-1">Opties:</th>
                </thead>
                <tbody>';

                foreach($requests as $feature){

                echo '
                <tr>
                    <td>';

                    if($feature->state == 1){
                        echo 'voltooid';
                    }elseif($feature->state == 2){
                        echo 'in behandeling';
                    }elseif($feature->state == 3){
                        echo 'afgewezen';
                    }elseif($feature->state == 4){
                        echo 'vraag';
                    }else{
                        echo 'open';
                    }

                    echo '
                    </td>
                    <td>'.$feature->request.'</td>
                    <td>
                        <a href="Main/mod_request/'.$feature->id.'/"><span class="label label-warning">Bewerk</a></span>
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



