<?php
if(mySession::isSet('id')){ ?>
    <div class="container">
        <h2>Profil <?= $_SESSION['jmeno'] ?></h2>
    </div>
    <?php
} ?>
