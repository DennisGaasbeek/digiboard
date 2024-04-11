<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-user"></span> Accountbeheer.
                <div class="pull-right"><a href="/add_user"><span class="badge"><span class="glyphicon glyphicon-plus"></span> nieuw account aanmaken</span></a></div>
            </div>
            <div class="panel-body">
            <div class="alert alert-info" role="alert">
            Beheer de accounts die toegang hebben tot het admin gedeelte van deze applicatie.
            </div>

            <table class="table borderless">
                <thead>
                    <th>Naam:</th>
                    <th>Mailadres:</th>
                    <th>Telefoon:</th>
                    <th>Login:</th>
                    <th>Opties:</th>
                </thead>
                <tbody>
                <?php

                foreach($users as $user){

                echo '
                <tr>
                    <td>'.$user->name.'</td>
                    <td>'.$user->mail.'</td>
                    <td>'.$user->phone.'</td>';

                    if($user->login == '0000-00-00'){
                    echo '<td>nooit</td>';
                    }else{
                    echo '<td>'.date("d-m-Y", strtotime($user->login)).'</td>';
                    }

                    echo'
                    <td>';

                    if($this->session->account != $user->id){
                        echo '<a onClick="return confirm(\''.$user->name.' permanent verwijderen?\')" href="Main/del_user/'.$user->id.'/"><span class="label label-danger">Verwijder</a></span>';
                    }else{
                        echo '<a onClick="return confirm(\'Je kunt je eigen account niet verwijderen!\')"><span class="label label-default">Verwijder</a></span>';
                    }

                    echo'
                    </td>
                </tr>
                ';

                }

                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>