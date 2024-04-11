<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-play"></span> Videoslide toevoegen.
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-12">
                    <div class="alert alert-warning no_radius" role="alert">Stem de duratie af met de duur van de video.</div>
                    </div>
                </div>


                <?php

                echo form_open('save_videoslide');

                $discription = array('name' => 'discription', 'maxlength' => '150','required' => 'required', 'class' => 'form-control input_1');
                $youtube = array('name' => 'youtube','maxlength' => '300', 'class' => 'form-control input_1', 'id' => 'countdown');

    				$active = array(
    					'1' => 'ja, deze slide publiceren na opslaan',
    					'0' => 'nee, alleen opslaan',
                    );

                $active = form_dropdown('active', $active, '1', 'class="form-control input_1"');

    				$font = array(
    					'black' => 'zwart',
    					'white' => 'wit',
                    );

                $font = form_dropdown('font', $font, 'white', 'class="form-control input_1"');
                $delay = array('name' => 'delay','maxlength' => '5', 'class' => 'form-control input_1', 'required' => 'required');

                $directory = './data/wallpapers';
                $wallpapers = array_diff(scandir($directory), array('..', '.'));

                ?>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <label>Slide beschrijving</label>
                        <?php echo form_input($discription); ?>
                    </div>

                    <div class="col-md-2">
                        <label>Publiceren</label>
                        <?php echo $active; ?>
                    </div>

                    <div class="col-md-2">
                        <label>Wallpaper</label>
                        <select name="wallpaper" class="form-control input_1">
                        <?php

                        foreach($wallpapers as $wallpaper){

                            echo '<option value="'.$wallpaper.'">'.$wallpaper.'</option>';

                        }

                        ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label>Duratie (00:00).</label>
                        <?php echo form_input($delay); ?>
                    </div>

                    <div class="col-md-8 row">
                        <br />
                        <div class="col-md-4">
                        <label>Youtube link</label>
                        <?php echo form_input($youtube); ?>
                        </div>

                        <div class="col-md-4">
                        <img src="/data/img/youtube.png" style="width: 350px; border-left: 5px solid #000;">
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <br />
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
    var maxCharacters = 300;
    document.getElementById('countdown').onkeyup = function() {
      document.getElementById('characters-counter').innerHTML = (maxCharacters - this.value.length);
    };
});
</script>