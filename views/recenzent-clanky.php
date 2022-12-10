<?php

global $dataFetch;

?>

<script src="<?= DIR_UTILITY ?>js/clanky.js"></script>

<div class="container">

    <div class="card mt-2">
        <div class="card-header">
            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#clanek"><h4>Články</h4></button>
        </div>
        <div id="clanek" class="collapse show">
            <div class="card-body">
                <?php
                foreach ($dataFetch['clanky'] as $res){
                    if($res['hotova'] != 1){ ?>
                    <div class="container border border-secondary rounded p-3 mt-2">
                        <div class="row">
                            <div class="col-sm-8">
                                <h4><?= $res['nazev'] ?></h4>
                                <p class="lead"><i class="fa fa-user"></i> <?= $res['jmeno'] ?></p>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" onClick=togglePDF('<?= $res['id_clanek'] ?>') class="btn btn-outline-secondary m-1 pull-right">Zobrazit</button>
                            </div>
                        </div>
                        <div>
                            <p><?= $res['abstrakt'] ?></p>
                            <iframe src="<?= DIR_UTILITY ?>/pdf/<?= $res['soubor'] ?>.pdf" id="PDF_<?= $res['id_clanek'] ?>" width="100%" height="400px" style="display:none"></iframe>
                        </div>
                    </div>
                <?php }
                } ?>

            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#novyClanek"><h4>Napsat recenzi</h4></button>
        </div>
        <div id="novyClanek" class="collapse show">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container">
                        <span id="rateMe4"  class="feedback"></span>
                    </div>
                    <p>Článek:</p>
                    <select name="id_clanek" class="form-control mb-2">
                        <option hidden value="0"></option>
                    <?php
                    foreach($dataFetch['clanky'] as $art){
                        if($art['hotova'] != 1){ ?>
                        <option value="<?= $art['recenze_id_clanek'] ?>"><?= $art['nazev'] ?></option>
                    <?php }
                    } ?>

                    </select>
                    <p>Kvalita:</p>
                    <select name="kvalita" class="form-control mb-2 text-warning" style="font-family: fontAwesome">
                        <option hidden value="0"></option>
                        <option value="1">&#xf005;</option>
                        <option value="2">&#xf005;&#xf005;</option>
                        <option value="3">&#xf005;&#xf005;&#xf005;</option>
                        <option value="4">&#xf005;&#xf005;&#xf005;&#xf005;</option>
                        <option value="5">&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;</option>
                    </select>
                    <p>Jazyk:</p>
                    <select name="jazyk" class="form-control mb-2 text-warning" style="font-family: fontAwesome">
                        <option hidden value="0"></option>
                        <option value="1">&#xf005;</option>
                        <option value="2">&#xf005;&#xf005;</option>
                        <option value="3">&#xf005;&#xf005;&#xf005;</option>
                        <option value="4">&#xf005;&#xf005;&#xf005;&#xf005;</option>
                        <option value="5">&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;</option>
                    </select>
                    <p>Originalita:</p>
                    <select name="originalita" class="form-control mb-2 text-warning" style="font-family: fontAwesome">
                        <option hidden value="0"></option>
                        <option value="1">&#xf005;</option>
                        <option value="2">&#xf005;&#xf005;</option>
                        <option value="3">&#xf005;&#xf005;&#xf005;</option>
                        <option value="4">&#xf005;&#xf005;&#xf005;&#xf005;</option>
                        <option value="5">&#xf005;&#xf005;&#xf005;&#xf005;&#xf005;</option>
                    </select>
                    <button name="rate" class="btn btn-success form-control mb-2" type="submit">Přidat recenzi</button>
                </form>
            </div>
        </div>
    </div>

</div>

