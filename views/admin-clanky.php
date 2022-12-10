<?php

global $dataFetch;
global $queryResult;

if(mySession::isSet('uroven') && mySession::get('uroven') >= 3){?>
    <div class="container">
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title mb-0">Spravovat články</h5>
            </div>

            <?php
            if (isset($queryResult)) {
                if ($queryResult == 0) { ?>
                    <div class="alert alert-success text-center" role="alert">
                        <div class="container">
                            <b>Akce byla úspěšná.</b>
                        </div>
                    </div>
                    <?php
                } else if ($queryResult == 1) { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <div class="container">
                            <b>Akce nebyla úspěšná.</b>
                            <p>Nedostatečné oprávnění.</p>
                        </div>
                    </div>
                    <?php
                } else if ($queryResult == 2) { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <div class="container">
                            <b>Akce nebyla úspěšná.</b>
                            <p>Před smazáním uživatele smažte jeho články.</p>
                        </div>
                    </div>
                    <?php
                }
            } ?>

            <table class="table table-striped table-sm mb-0">
                <thead>
                <tr>
                    <th class="border-0 col-auto">ID</th>
                    <th class="border-0 col-auto">Název</th>
                    <th class="border-0 col-auto">Autor</th>
                    <th class="border-0 col-auto">Stav</th>
                    <th class="border-0 col-auto">Detail</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($dataFetch['clanky'] as $res){ ?>
                    <tr class="align-middle">
                        <td><?= $res['id_clanek'] ?></td>
                        <td><?= $res['nazev'] ?></td>
                        <td><?= $res['jmeno'] ?></td>
                        <td>

                            <?php
                            if($res['schvalen'] == 1){
                                echo "<span class='text-success'>Schválen</b>";
                            } else {
                                echo "<span class='text-danger'>Neschválen</b>";
                            } ?>

                        </td>
                        <td>
                            <button name="update" type="submit" class="btn btn-outline-success ml-2"><i class="fa fa-info"></i></button>
                        </td>
                        </form>
                        <?php } ?>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

<?php } ?>