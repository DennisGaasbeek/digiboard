<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-picture"></span> Wallpapers.
                <div class="pull-right"><a href="/add_wallpaper"><span class="badge"><span class="glyphicon glyphicon-plus"></span> wallpaper toevoegen</span></a></div>
            </div>
            <div class="panel-body">
            <div class="alert alert-warning" role="alert">
            Wallpapers bepalen de achtergrond van slides. De wallpaper is in te stellen per slide.<br />
            Verwijder je een wallpaper die wordt gebruikt door een slide? <strong>Dan wordt ook de slide verwijderd!</strong><br />
            De optimale resolutie voor wallpapers is 1920x1080px of hoger. Het bestand mag niet groter zijn dan 750KB!
            </div>

            <?php

            if(count($wallpapers) == 0){

            echo 'Geen data.';

            }else{

            echo '
            <table class="table borderless">
                <thead class="thead_border">
                    <th></th>
                    <th class="col-md-10">Bestand:</th>
                    <th class="col-md-2">Opties:</th>
                </thead>
                <tbody>';

                foreach($wallpapers as $wallpaper){

                $wallpaper_id = str_replace('=', '',base64_encode($wallpaper));
                $url = 'https://digiboard.businessheuvelrug.nl/data/wallpapers/'.$wallpaper;

                echo '
                <tr>
                    <td>
                        <div id="preview">
                            <a style="color: #000 !important;" data-toggle="tooltip" title="<img style=\'max-width: 150px; max-height: 150px;\' src=\'./data/wallpapers/'.$wallpaper.'\' />"><span class="glyphicon glyphicon-picture"></span></a>
                        </div>
                    <td>'.$wallpaper.'</td>
                    <td>
                        <a onClick="return confirm(\'Wallpaper permanent verwijderen? Hiermee worden ook slides die gebruik maken van de wallpaper verwijderd!\')" href="Main/del_wallpaper/'.$wallpaper_id.'/"><span class="label label-danger">Verwijder</a></span>
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


