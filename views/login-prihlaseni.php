<?php

global $queryResult;

?>

<div class="container text-center p-4 w-500px">
    <div class="border border-secondary border-top rounded-top shadow slightly-green-background p-4">
        <h3 class="">Přihlášení</h3>

        <?php
        if (isset($queryResult)) {
            if ($queryResult == 1) { ?>
            <div class="alert alert-danger text-center" role="alert">
                <div class="container">
                    <b>Nesprávné uživatelské jméno nebo heslo.</b>
                </div>
            <?php
            }
        } ?>

        <form action="" method="post">
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="lJmeno" placeholder="Uživatelské jméno" class="form-control" id="labelJmeno" required>
                <label for="labelJmeno" class="smaller-label">Uživatelské jméno</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="lHeslo" placeholder="Heslo" class="form-control" id="labelHeslo" required>
                <label for="labelHeslo" class="smaller-label">Heslo</label>
            </div>
            <button name="lSubmit" class="btn btn-success form-control" type="submit">Přihlásit se</button>

        </form>
    </div>

    <?php
    if(isset($queryResult) && $queryResult == 1){
        echo "</div>";
    } ?>

    <div class="border border-secondary border-bottom rounded-bottom shadow slightly-green-background mt-3">
        <div class="mt-2 mb-2">
            <span>Jste tu nový?</span>
            <a href="index.php?page=registrace" class="link-success no-underline-link">Registrujte se</a>
        </div>
    </div>
</div>

