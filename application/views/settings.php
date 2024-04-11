<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-cog"></span> Settings.
            </div>
            <div class="panel-body">
            <div class="alert alert-info" role="alert">
            Bepaal hier of de teletekst pagina moet worden weergegeven op wedstrijd (zaterdag tussen 14:15 uur en 17:00 uur) en van welke teletekst pagina data er opgehaald dient te worden.
            </div>

            <?php
            echo form_open('save_settings');
            foreach($settings as $setting){}

            $page = array('name' => 'page', 'type' => 'number', 'maxlength' => '3','required' => 'required', 'class' => 'form-control input_1', 'value' => $setting->teletekst_pagina);
            $active = array(
            	'1' => 'ja, weergeven op wedstrijddagen',
            	'0' => 'nee',
            );

            $active = form_dropdown('active', $active, $setting->teletekst, 'class="form-control input_1"');


                echo '
                <div class="col-md-12">
                    <div class="col-md-1">
                        <label>Teletekst pagina</label>';
                        echo form_input($page);

                    echo '
                    </div>
                    <div class="col-md-2">
                        <label>Teletekst aan?</label>';

                        echo $active;

                    echo '
                    </div>
                </div>

                <div class="col-md-12">
                    <hr />
                    <div class="col-md-1">';

                    echo form_submit('submit', 'opslaan', 'class="btn btn-submit btn-default"');

                    echo '
                    </div>
                </div>';

                echo form_close();

            ?>


            </div>

        </div>
    </div>
</div>
