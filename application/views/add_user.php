<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-user"></span> Account toevoegen.
            </div>
            <div class="panel-body">

            <?php

            if($feedback != ''){
            echo '
            <div class="alert alert-danger" role="alert">
            '.$feedback.'
            </div>';

            }else{
            echo '
            <div class="alert alert-info" role="alert">
            Maak via onderstaand formulier een nieuw account aan. De gebruiker ontvangt een mail met het wachtwoord.
            </div>';
            }



                echo form_open('save_user');

                $name = array('name' => 'name', 'maxlength' => '100','required' => 'required', 'class' => 'form-control input_1');
                $mail = array('name' => 'mail', 'type' => 'email', 'maxlength' => '100','required' => 'required', 'class' => 'form-control input_1');
                $phone = array('name' => 'phone', 'type' => 'number', 'maxlength' => '10','required' => 'required', 'class' => 'form-control input_1');

                ?>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <label>Naam</label>
                        <?php echo form_input($name); ?>
                    </div>
                    <div class="col-md-4">
                        <label>E-mailadres</label>
                        <?php echo form_input($mail); ?>
                    </div>
                    <div class="col-md-2">
                        <label>Mobiel</label>
                        <?php echo form_input($phone); ?>
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