<?php

global $dataFetch;

?>

<script src="<?= DIR_UTILITY ?>js/clanky.js"></script>

<div class="container">

    <div class="card mt-2">
        <div class="card-header">
            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#novyClanek"><h4>Napsat recenzi</h4></button>
        </div>
        <div id="novyClanek" class="collapse show">
            <div class="card-body">

                <?php
                if (isset($queryResult)) {
                if ($queryResult == 0) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <div class="container mb-2">
                        <b>Přidání článku bylo úspěšné.</b>
                    </div>
                    <?php } else if ($queryResult == 1) { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <div class="container mb-2">
                            <b>Přidání článku nebylo úspěšné.</b>
                            <p>Článek s tímto názvem existuje.</p>
                        </div>
                        <?php } else if ($queryResult == 2) { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <div class="container mb-2">
                                <b>Přidání článku nebylo úspěšné.</b>
                                <p>Nahraný soubor není typu PDF.</p>
                            </div>
                            <?php } else if ($queryResult == 3) { ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <div class="container mb-2">
                                    <b>Přidání článku nebylo úspěšné.</b>
                                    <p>Chyba nahrání souboru.</p>
                                </div>
                                <?php }
                                } ?>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="cNazev" placeholder="Název článku" class="form-control" id="labelNazev" required>
                                        <label for="labelNazev" class="smaller-label">Název článku</label>
                                    </div>
                                    <textarea name="cAbstrakt" placeholder="Abstrakt" class="form-control" rows="3" required></textarea>
                                    <div class="mt-3 mb-3">
                                        <input type="file" name="cSoubor" accept="application/pdf" id="cSoubor" class="form-control" required>
                                    </div>
                                    <button name="cSubmit" class="btn btn-success form-control" type="submit">Přidat článek</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    if(isset($queryResult)){
                        echo "</div>";
                    } ?>

                    <div class="card mt-2">
                        <div class="card-header">
                            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#mojeClanky"><h4>Moje recenze</h4></button>
                        </div>
                        <div id="mojeClanky" class="collapse show">
                            <div class="card-body">

                                <?php
                                foreach ($dataFetch['clanky'] as $res){
                                    $text = "Neschválen";
                                    $border = "border-danger slightly-red-background";
                                    $button = "btn-outline-danger";
                                    $color = "text-danger";
                                    if($res['schvalen'] == 1) {
                                        $text = "Schválen";
                                        $border = "border-success slightly-green-background";
                                        $button = "btn-outline-success";
                                        $color = "text-success";
                                    } ?>

                                    <div class="container border <?= $border ?> rounded p-3 mt-2">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <b class="<?= $color ?>"><?= $text ?></b>
                                                <h4><?= $res['nazev'] ?></h4>
                                                <p class="lead"><i class="fa fa-user"></i> <?= $res['jmeno'] ?></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" onClick=togglePDF('<?= $res['id_clanek'] ?>') class="btn <?= $button ?> m-1 pull-right">Zobrazit</button>
                                            </div>
                                        </div>
                                        <div>
                                            <p><?= $res['abstrakt'] ?></p>
                                            <iframe src="<?= DIR_UTILITY ?>/pdf/<?= $res['soubor'] ?>.pdf" id="PDF_<?= $res['id_clanek'] ?>" width="100%" height="400px" style="display:none"></iframe>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
