<?php

global $dataFetch;
global $queryResult;

if(mySession::isSet('uroven') && mySession::get('uroven') >= 3){?>
    <div class="container">
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title mb-0">Spravovat články</h5>
            </div>
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
                            <button onclick="location.href='index.php?page=admin-recenze&id=<?= $res['id_clanek'] ?>'" class="btn btn-outline-success ml-2 w-40px"><i class="fa fa-info"></i></button>
                        </td>
                        </form>
                        <?php } ?>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

<?php } ?>