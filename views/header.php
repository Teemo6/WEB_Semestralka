<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>codingFriends</title>
    <link rel=icon href=<?= DIR_UTILITY ?>img/logoSmall.png>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="http://localhost/stranky/WEB_Semestralka/util/css/betterBootstrap.css" rel="stylesheet">

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>

<body>
<!-- HEADER -->
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1 mb-3 border-bottom">
        <a href="index.php?page=clanky" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="<?= DIR_UTILITY ?>img/logo.png" class="img-fluid" width="225" alt="{codingFriends}">
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="index.php?page=clanky" class="nav-link link-success no-underline-link"><h5>Články</h5></a></li>
            <li><a href="index.php?page=profil" class="nav-link link-success no-underline-link"><h5>Profil</h5></a></li>
            <li><a href="#" class="nav-link link-success no-underline-link"><h5>O projektu</h5></a></li>
        </ul>

        <div class="col-md-3 text-end">

            <?php
            if(mySession::isSet('id')){ ?>
                    <form action="index.php?page=odhlaseni" method="post" class="text-center">
                        <b><?= $_SESSION["jmeno"] ?></b>
                        <button type="submit" name="oSubmit" class="btn btn-outline-danger m-1 w-110px">Odhlásit</button>
                    </form>
            <?php
            } else { ?>
                <button onclick="location.href='index.php?page=prihlaseni'" type="button" class="btn btn-outline-success m-1 w-110px">Přihlásit</button>
                <button onclick="location.href='index.php?page=registrace'" type="button" class="btn btn-success m-1 w-110px">Registrovat</button>
            <?php } ?>

        </div>
    </header>
</div>
<!-- CONTENT -->