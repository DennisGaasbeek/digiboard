<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-bullhorn"></span> Feature request toevoegen.
            </div>
            <div class="panel-body">

                <?php

                echo form_open('save_request');

                $title = array('name' => 'title', 'maxlength' => '255','required' => 'required', 'class' => 'form-control input_1');
                $content = array('name' => 'content','class' => 'form-control input_1','required' => 'required', 'id' => 'countdown');

                ?>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <label>Verzoek</label>
                        <?php echo form_input($title); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-8">
                        <br />
                        <label>Beschrijving</label>
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