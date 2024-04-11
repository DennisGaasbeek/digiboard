<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-user"></span> Sponsor toevoegen.
            </div>
            <div class="panel-body">

                <?php

                if($msg == 'invalid'){

                echo '
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-danger no_radius" role="alert">Het opgegeven bestand lijkt geen afbeelding te zijn of is te groot (meer dan 256KB).</div>
                    </div>
                </div>';

                }

                echo form_open_multipart('save_sponsor');

                $name = array('name' => 'name', 'maxlength' => '150','required' => 'required', 'class' => 'form-control input_1');

                ?>

                <div class="col-md-12">
                    <div class="col-md-3">
                        <label>Sponsor</label>
                        <?php echo form_input($name); ?>
                    </div>

                    <div class="col-md-3">
                        <label>Logo (.png/.jpg/.jpeg) (max. 256KB)</label>
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