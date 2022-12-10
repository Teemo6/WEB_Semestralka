<?php

global $dataFetch;

?>

<script src="<?= DIR_UTILITY ?>js/clanky.js"></script>

<div class="container">
    <div class="container">
        <h3 class="mt-3">Webová konference na téma programování</h3>
    </div>
    <div class="container">

        <?php
        if(isset($dataFetch['clanky'])){
            foreach ($dataFetch['clanky'] as $res){ ?>
                <div class="container border border-secondary rounded p-3 mt-2">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4><?= $res['nazev'] ?></h4>
                            <p class="lead"><i class="fa fa-user"></i> <?= $res['jmeno'] ?></p>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" onClick=togglePDF('<?= $res['id_clanek'] ?>') class="btn btn-outline-success m-1 pull-right">Zobrazit</button>
                        </div>
                    </div>
                    <div>
                        <p><?= $res['abstrakt'] ?></p>
                        <iframe src="<?= DIR_UTILITY ?>/pdf/<?= $res['soubor'] ?>" id="PDF_<?= $res['id_clanek'] ?>" width="100%" height="400px" style="display:none"></iframe>
                    </div>
                </div>
            <?php
            }
        } ?>

    </div>
</div>
