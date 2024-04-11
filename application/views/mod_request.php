<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-bullhorn"></span> Feature request aanpassen.
            </div>
            <div class="panel-body">

                <?php

                foreach($request as $request){

                echo form_open('/Main/update_request/'.$request->id.'/');

    				$state = array(
                        '0' => 'open',
                        '1' => 'voltooid',
                        '2' => 'in behandeling',
                        '3' => 'afgewezen',
                        '4' => 'meer informatie nodig',
                    );

                $state = form_dropdown('state', $state, $request->state, 'class="form-control input_1"');

                $title = array('name' => 'title', 'maxlength' => '255','required' => 'required', 'class' => 'form-control input_1', 'value' => $request->request);
                $content = array('name' => 'content','class' => 'form-control input_1','required' => 'required', 'id' => 'countdown', 'value' => $request->discription);
                $opmerkingen = array('name' => 'comment','class' => 'form-control input_1', 'id' => 'countdown', 'value' => $request->comment);

                }

                ?>

                <div class="col-md-12">
                    <div class="col-md-4">
                        <label>Verzoek</label>
                        <?php echo form_input($title); ?>
                    </div>
                    <div class="col-md-2">
                        <label>Status</label>
                        <?php echo $state; ?>
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
                    <div class="col-md-8">
                        <br />
                        <label>Kladblok</label>
                        <?php echo form_textarea($opmerkingen); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr />
                    <div class="col-md-1">
                    <?php echo form_submit('submit', 'opslaan', 'class="btn btn-submit btn-default"'); ?>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>