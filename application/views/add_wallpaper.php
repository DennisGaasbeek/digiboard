<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-picture"></span> Wallpaper toevoegen.
            </div>
            <div class="panel-body">

                <?php

                if($msg == 'invalid'){

                echo '
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-danger no_radius" role="alert">Het opgegeven bestand lijkt geen afbeelding te zijn of het bestand is groter dan 750KB!</div>
                    </div>
                </div>';

                }

                echo form_open_multipart('save_wallpaper');

                ?>

                <div class="col-md-12">
                    <div class="col-md-3">
                        <label>Afbeelding (.png/.jpg/.jpeg) (max. 750KB)</label>
                        <input type="file" name="file" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr />
                    <div class="col-md-1">
                    <?php echo form_submit('submit', 'aanmaken', 'class="btn btn-submit btn-default"'); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>