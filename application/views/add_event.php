<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-calendar"></span> Evenement toevoegen.
            </div>
            <div class="panel-body">

                <?php

                if($msg == 'invalid'){

                echo '
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-danger no_radius" role="alert">Het opgegeven bestand lijkt geen afbeelding te zijn of het bestand is te groot (500KB)!</div>
                    </div>
                </div>';

                }

                echo form_open_multipart('save_event');

                $title = array('name' => 'title', 'maxlength' => '50','required' => 'required', 'class' => 'form-control input_1');
                $date = array('name' => 'date', 'type' => 'date', 'class' => 'form-control input_1','required' => 'required');
                $content = array('name' => 'content', 'maxlength' => '200', 'class' => 'form-control input_1','required' => 'required', 'id' => 'countdown');

                ?>

                <div class="col-md-12">
                    <div class="col-md-2">
                        <label>Datum</label>
                        <?php echo form_input($date); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <br />
                        <label>Titel</label>
                        <?php echo form_input($title); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                    <br />
                    <label>Afbeelding (.png/.jpg/.jpeg)</label>
                    <input type="file" name="file">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <br />
                        <label>Beschrijving - <span id="characters-counter">200</span> tekens resterend</label>
                        <?php echo form_textarea($content); ?>
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
<script>
$(document).ready(function() {
        var maxCharacters = 200;
        document.getElementById('countdown').onkeyup = function() {
            document.getElementById('characters-counter').innerHTML = (maxCharacters - this.value.length);
        };
});
</script>