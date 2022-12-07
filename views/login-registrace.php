<?php

global $queryResult;

?>

<div class="container text-center p-4 w-500px">
    <div class="border border-secondary border-top rounded-top shadow slightly-different-background p-4">
        <h3>Registrace</h3>

        <?php
        if (isset($queryResult)) {
            if ($queryResult == 0) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <div class="container">
                        <b>Registrace byla úspěšná.</b>
                    </div>
                <?php
            } else if ($queryResult == 1) { ?>
                <div class="alert alert-danger text-center" role="alert">
                    <div class="container">
                        <b>Registrace nebyla úspěšná.</b>
                        <p>Tento uživatel již existuje.</p>
                    </div>
                <?php
            } else if ($queryResult == 2) { ?>
                <div class="alert alert-danger text-center" role="alert">
                    <div class="container">
                        <b>Registrace nebyla úspěšná.</b>
                        <p>Tento e-mail je již použit.</p>
                    </div>
                <?php
            } else if ($queryResult == 3) { ?>
                <div class="alert alert-danger text-center" role="alert">
                     <div class="container">
                         <b>Registrace nebyla úspěšná.</b>
                         <p>Hesla se neshodují.</p>
                     </div>
                <?php
            }
        } ?>

        <form method="post">
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="rJmeno" placeholder="Uživatelské jméno" class="form-control" id="labelJmeno" required>
                <label for="labelJmeno" class="smaller-label">Uživatelské jméno</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="email" name="rEmail" placeholder="E-mail" class="form-control" id="labelEmail" required>
                <label for="labelEmail" class="smaller-label">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="rHeslo" placeholder="Heslo" class="form-control" id="labelHeslo" required>
                <label for="labelHeslo" class="smaller-label">Heslo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="rHeslo2" placeholder="Heslo znovu" class="form-control" id="labelHeslo2" required>
                <label for="labelHeslo2" class="smaller-label">Heslo znovu</label>
            </div>
            <button name="rSubmit" class="btn btn-success form-control" type="submit">Registrovat se</button>
        </form>
    </div>

    <?php
    if(isset($queryResult)){
       ?></div><?php
    } ?>

    <div class="border border-secondary border-bottom rounded-bottom shadow slightly-different-background mt-3">
        <div class="mt-2 mb-2">
            <span>Již máte účet?</span>
            <a href="index.php?page=prihlaseni" class="link-success no-underline-link">Přihlaste se</a>
        </div>
    </div>
</div>
