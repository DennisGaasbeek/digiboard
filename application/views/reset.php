<div class="col-md-12 space_top_login">
	<div class="col-md-4 col-md-offset-4">
	    <img src="<?php echo base_url(); ?>data/img/logo_200_45.png" style="width: 200px; margin-bottom: 50px;">
		<div class="panel panel-default">
			<div class="panel-heading panel_background"><span class="glyphicon glyphicon-lock"></span> Wachtwoord reset</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="col-md-8">
							<form action="<?php base_url(); ?>/recover" method="post" accept-charset="utf-8">
							<label>Mail:</label><br />
							<input type="email" name="user" value="" maxlength="255" required="required" class="form-control input_1"  />
							<br />
							<input type="submit" name="submit" value="herstel"  class="btn btn-submit btn-default" />
						
						</div>
							
					</div>
					<div class="col-md-12"><br />
					
					<?php

						if($msg == 'invalid'){
							echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">Account onbekend!</div></div>';
                        }

						if($msg == 'valid'){
                            echo '<div class="col-md-12"><div class="alert alert-info" role="alert">Controleer de mailbox om de reset uit te voeren.</div></div>';
                        }

						if($msg == 'incorrect_link'){
                            echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">De recoverylink is incorrect!</div></div>';
                        }

						if($msg == 'restored'){
                            echo '<div class="col-md-12"><div class="alert alert-info" role="alert">Er is een nieuw wachtwoord verzonden via de mail. Klik <a href="/admin">hier</a> om opnieuw in te loggen.</div></div>';
                        }
					
					?>

					</div>
				</div>
		</div>
	</div>
</div>