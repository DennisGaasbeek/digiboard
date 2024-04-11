<div class="col-md-12">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading panel_background">
                <span class="glyphicon glyphicon-info-sign"></span> Hardware info.
            </div>
            <div class="panel-body">
            <div class="alert alert-warning" role="alert">
            Deze info is voor technici en bevat informatie over het configureren van de Digiboard Raspberry Pi en aanverwante hardware.
            </div>

            <h4>Welke hardware draait Digiboard op?</h4>
            Raspberry Pi4, 2GB met 16GBMicroSD.<br /><br />

            <h4>Hoe worden de TV's aangestuurd?</h4>
            De TV's zijn aangesloten op een HDMI splitter. Een Raspberry Pi4 is aangesloten op de input van de HDMI splitter. De Raspberry Pi4 is de hardware die de slides weergeeft.
            <br /><br />
            <h4>Hoe herstart ik de digiboard Raspberry Pi?</h4>
            Maak het apparaat 5 seconden stroomloos en sluit deze vervolgens weer aan.
            <br /><br />
            <h4>Alle content is extreem klein of extreem groot (past niet op scherm).</h4>
            Het kan zijn dat de Raspberry Pi de resolutie van de TV overneemt, dit is niet altijd gewenst.<br />De beste resolutie die bekend moet zijn is 1920x1080.
            <br /><br />

            <h4>Presenter modus</h4>
            Het is mogelijk om slides over te slaan met een presenter. Hiervoor dien je 2x (dubbelklik) op de play knop van de presenter te klikken.<br />
            Druk niet als een bezetene meerdere malen op deze knop om snel slides over te slaan, het Digiboard heeft even nodig om acties te verwerken.<br />
            <img src="/data/img/presenter.png">
            <br /><br/>

            <h4>Hoe log ik in op de Raspberry Pi4?</h4>
            Zoek het ip adres op via advanced ip scanner of via de ARP cache in de router, het MAC adres is E4-5F-01-FA-1F-05.<br />
            Start een ssh sessie middels Putty en geeft het ip-adres op met poort 22 (ssh). Dit kan alleen op het interne netwerk.<br >
            Geef als username <strong>pi</strong> op.<br />
            En als wachtwoord <strong>debusin3ssCLUB</strong><br />
            <br />
            <img src="/data/img/a.png"><br /><br /><img src="/data/img/b.png">

            <br /><br />
            <h4>Hoe stop je de autostart van de digiboard app (desktop modus)?</h4>
            Als je de desktop van de Raspberry wilt benaderen dient de digiboard app afgesloten te worden, dit kan als volgt:<br />
            1. Login via SSH.<br />
            2. Type "sudo nano /etc/xdg/autostart/display.desktop" gevolgd door een enter.<br />
            3. Comment (ofwel plaats er een # voor) de lijnen Type= en Exec=. Zie voorbeeld:<br />
            <img src="/data/img/c.png"><br />
            4. Type CTRL + O gevolgt door enter. <br/>
            5. Klik op CTRL + X.<br />
            5. Restart via "sudo reboot now", er vindt een reboot plaats waarbij de desktop wordt geladen i.p.v. de digiboard app.<br />
            <strong>Om dit terug te draaien uncomment je de 2 lijnen weer (stap 3) en voer je weer een reboot uit.</strong><br />
            <br />

            <h4>Hoe pas je de resolutie aan?</h4>
            1. Klik op de raspberry pi icon linksboven en gaar naar preferences, screen configuration.<br />
            2. Ga naar het tab configure, screens, HDMI-1, Resolution, 1920x1080 (beste resolutie voor digiboard modus).<br />
            <img src="/data/img/d.jpg"><br /><br />
            3. Klik op apply.<br />
            4. Herstart (of maak tijdelijk stroomloos).<br /><br />


            <h4>Client scripts (aanwezig op de Raspberry Pi):</h4>
            /home/pi/dashboard.sh<br />
            ----------------------------------------------
            <br />
            #!/bin/bash<br />
            xset s noblank<br />
            xset s off<br />
            xset -dpms<br />
            <br />
            unclutter -idle 0.5 -root &<br />
            <br />
            sed -i 's/"exited_cleanly":false/"exited_cleanly":true/' /home/pi/.config/chromium/Default/Preferences<br />
            sed -i 's/"exit_type":"Crashed"/"exit_type":"Normal"/' /home/pi/.config/chromium/Default/Preferences<br />
            <br />
            /usr/bin/chromium-browser --noerrdialogs --disable-infobars --kiosk https://digiboard.businessheuvelrug.nl &<br /><br />

            /etc/xdg/autostart/display.desktop<br />
            ----------------------------------------------
            <br />
            [Desktop Entry]<br />
            Type=Dashy<br />
            Exec=/home/pi/dashboard.sh<br /><br />


            </div>
        </div>
    </div>
</div>


