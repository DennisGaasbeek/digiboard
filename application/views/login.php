<div class="col-md-12 space_top_login">
	<div class="col-md-4 col-md-offset-4">
	    <img src="<?php echo base_url(); ?>data/img/logo_200_45.png" style="width: 200px; margin-bottom: 50px;">
		<div class="panel panel-default">
			<div class="panel-heading panel_background"><span class="glyphicon glyphicon-lock"></span> Digiboard login</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="col-md-8">
							<form action="<?php base_url(); ?>/access" method="post" accept-charset="utf-8">
							<label>Email:</label><br />
							<input type="email" name="user" value="" maxlength="255" required="required" class="form-control input_1"  />
							<br />

							<label>Wachtwoord:</label><br />
							<input type="password" name="pass" value="" maxlength="255" required="required" class="form-control input_1"  />
							<br />									
							<input type="submit" name="submit" value="aanmelden"  class="btn btn-submit btn-default" />
						
						</div>
							
					</div>
					<div class="col-md-12"><br />
					
					<?php

						if($status == 'invalid'){
							echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">Login incorrect! Wachtwoord vergeten? Klik <a href="/reset">hier</a> om deze te resetten.</div></div>';
						}
					
					?>
												
					</div>
				</div>
		</div>
	</div>	
</div>