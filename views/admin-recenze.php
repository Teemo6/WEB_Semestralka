<?php

global $dataFetch;
global $queryResult;

?>

<script src="<?= DIR_UTILITY ?>js/clanky.js"></script>
<div class="container">

    <div class="card mt-2">
        <div class="card-header">
            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#clanek"><h4>Článek</h4></button>
        </div>
        <div id="clanek" class="collapse show">
            <div class="card-body">
                <?php
                foreach ($dataFetch['clanek'] as $res){
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
                    <div class="row">
                        <form method="post">
                            <?php
                        if($res['schvalen'] == 1){ ?>
                            <button type="submit" name="artRevoke" class="btn btn-warning ml-2 w-110px pull-left">Odvolat</button>
                        <?php } else { ?>
                            <button type="submit" name="artConfirm" class="btn btn-success ml-2 w-110px pull-left">Schválit</button>
                        <?php } ?>
                            <button type="submit" name="artDelete" onclick="return confirm('Opravdu chcete smazat tento článek?')" class="btn btn-outline-danger ml-2 w-110px pull-right">Smazat</button>
                        </form>
                    </div>
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

    <div class="card mt-2">
        <div class="card-header">
            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#recenzenti"><h4>Recenze</h4></button>
        </div>
        <div id="recenzenti" class="collapse show">
            <div class="card-body">
                <table class="table table-striped table-sm mb-0">
                    <thead>
                    <tr>
                        <th class="border-0 col-auto">Recenzent</th>
                        <th class="border-0 col-auto">Kvalita</th>
                        <th class="border-0 col-auto">Jazyk</th>
                        <th class="border-0 col-auto">Originalita</th>
                        <th class="border-0 col-auto">Hotová</th>
                        <th class="border-0 col-auto">Smazat</th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($dataFetch['recenze'] as $res){ ?>
                        <tr class="align-middle">
                            <td><?= $res['jmeno'] ?></td>
                            <td><?= $res['kvalita'] ?></td>
                            <td><?= $res['jazyk'] ?></td>
                            <td><?= $res['originalita'] ?></td>
                            <td>

                            <?php
                            if($res['hotova'] == 1){
                                echo "<span class='text-success'>Ano</b>";
                            } else {
                                echo "<span class='text-danger'>Ne</b>";
                            } ?>

                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="recID" value="<?= $res['id_recenze'] ?>">
                                    <button type="submit" name="recDelete" onclick="return confirm('Opravdu chcete smazat recenzi uživatele <?= $res['jmeno'] ?>?')" class="btn btn-outline-danger ml-2 w-40px"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        <?php } ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <button class="btn form-control text-start" data-bs-toggle="collapse" data-bs-target="#pridat"><h4>Přidat recenzenta</h4></button>
        </div>
        <div id="pridat" class="collapse show">
            <div class="card-body">

                <?php
                if (isset($queryResult)) {
                    if ($queryResult == 1) { ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <div class="container">
                                <b>Akce nebyla úspěšná.</b>
                                <p>Recenzent je již přiřazen.</p>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
                <form method="post">
                    <select class='form-control mb-2' name='id_recenzent'>
                        <?php
                        foreach ($dataFetch['recenzenti_vsichni'] as $rec) {
                            echo "<option value='" . $rec['id_uzivatel'] . "'>" . $rec['jmeno'] . "</option>";
                        } ?>
                    </select>
                    <button name="recSubmit" class="btn btn-success form-control" type="submit">Potvrdit</button>
                </form>
            </div>
        </div>
    </div>
</div>