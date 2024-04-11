<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-calendar"></span> Evenement bewerken.
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-warning no_radius" role="alert">Als je geen afbeelding opgeeft, blijft de huidige bestaan.</div>
                    </div>
                </div>                

                <?php

                if($msg == 'invalid'){

                echo '
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-danger no_radius" role="alert">Het opgegeven bestand lijkt geen afbeelding te zijn of het bestand is te groot (500KB)!</div>
                    </div>
                </div>';

                }

                foreach($event as $event){

                echo form_open_multipart('/Main/update_event/'.$event->id.'/');

                $title = array('name' => 'title', 'maxlength' => '50','required' => 'required', 'class' => 'form-control input_1', 'value' => $event->title);
                $date = array('name' => 'date', 'type' => 'date', 'class' => 'form-control input_1','required' => 'required', 'value' => $event->date);
                $content = array('name' => 'content', 'maxlength' => '175', 'class' => 'form-control input_1','required' => 'required', 'value' => $event->content, 'id' => 'countdown');

                }

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
                    <div class="col-md-2">
                        <br />
                        <label>Afbeelding (.png/.jpg/.jpeg)</label>
                        <input type="file" name="file">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <br />
                        <label>Beschrijving - <span id="characters-counter">175</span> tekens resterend</label>
                        <?php echo form_textarea($content); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr />
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
        var maxCharacters = 175;
        document.getElementById('countdown').onkeyup = function() {
            document.getElementById('characters-counter').innerHTML = (maxCharacters - this.value.length);
        };
});
</script>