<?php

// Testing
global $dataFetch;
echo $dataFetch;

?>

<div class="container text-center p-4 w-500px">
    <div class="border border-secondary border-top rounded-top shadow slightly-different-background p-4">
        <h3 class="">Registrace</h3>
        <form method="post">
            <div class="form-floating mt-3 mb-3">
                <input type="text" name="registraceJmeno" placeholder="Uživatelské jméno" class="form-control" id="labelJmeno" required>
                <label for="labelJmeno" class="smaller-label">Uživatelské jméno</label>
            </div>
            <div class="form-floating mt-3 mb-3">
                <input type="email" name="registraceEmail" placeholder="E-mail" class="form-control" id="labelEmail" required>
                <label for="labelEmail" class="smaller-label">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="registraceHeslo" placeholder="Heslo" class="form-control" id="labelHeslo" required>
                <label for="labelHeslo" class="smaller-label">Heslo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="registraceHesloZnovu" placeholder="Heslo znovu" class="form-control" id="labelHesloZnovu" required>
                <label for="labelHesloZnovu" class="smaller-label">Heslo znovu</label>
            </div>
            <button name="registraceBtn" class="btn btn-success form-control" type="submit">Registrovat se</button>
        </form>
    </div>
    <div class="border border-secondary border-bottom rounded-bottom shadow slightly-different-background mt-3">
        <div class="mt-2 mb-2">
            <span>Již máte účet?</span>
            <a href="index.php?page=prihlaseni" class="link-success no-underline-link">Přihlaste se</a>
        </div>
    </div>
</div>
