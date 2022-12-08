<?php

global $dataFetch;
global $queryResult;

echo $queryResult;

/*
if(mySession::isSet('uroven') && mySession::get('uroven') >= 2){?>
    <div class="container">
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title mb-0">Spravovat uživatele</h5>
            </div>
            <table class="table table-striped table-sm mb-0 ">
                <thead>
                    <tr>
                        <th class="border-0 col-auto">#</th>
                        <th class="border-0 col-auto">Jméno</th>
                        <th class="border-0 col-auto">E-mail</th>
                        <th class="border-0 col-auto">Oprávnění</th>
                        <th class="border-0 col-auto">Editovat</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                foreach ($dataFetch['uzivatel'] as $res){ ?>
                    <tr class="align-middle">
                        <td><?= $res['id_uzivatel'] ?></td>
                        <td><?= $res['jmeno'] ?></td>
                        <td><?= $res['email'] ?></td>
                        <td><?= $res['nazev'] ?></td>
                        <td><button type="button" class="btn btn-outline-success ml-2"><i class="fa fa-edit"></i></button></td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

<?php } ?>
*/

if(mySession::isSet('uroven') && mySession::get('uroven') >= 2){?>
    <div class="container">
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title mb-0">Spravovat uživatele</h5>
            </div>
            <table class="table table-striped table-sm mb-0">
                <thead>
                <tr>
                    <th class="border-0 col-auto">ID</th>
                    <th class="border-0 col-auto">Jméno</th>
                    <th class="border-0 col-auto">E-mail</th>
                    <th class="border-0 col-auto">Oprávnění</th>
                    <th class="border-0 col-auto">Potvrdit</th>
                    <th class="border-0 col-auto">Smazat</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($dataFetch['uzivatel'] as $res){ ?>
                    <tr class="align-middle">
                        <td><?= $res['id_uzivatel'] ?></td>
                        <td><?= $res['jmeno'] ?></td>
                        <td><?= $res['email'] ?></td>
                        <td>
                            <?php
                            if((mySession::get('uroven') == 3 && $res['id_opravneni'] >= 3) || ($res['id_opravneni'] == 4)){
                                echo $res['nazev']."</td><td></td><td></td>";
                            } else {
                                echo "<form method='post'>";
                                echo "<input type='hidden' name='id_uzivatel' value='".$res['id_uzivatel']."'>";
                                echo "<select class='w-110px' name='id_opravneni'>";
                                foreach ($dataFetch['opravneni'] as $auth) {
                                    if((mySession::get('uroven') == 3 && $auth['id_opravneni'] >= 3) || ($auth['id_opravneni'] == 4)){
                                        continue;
                                    }
                                    $selected = "";
                                    if ($auth['nazev'] == $res['nazev']) {
                                        $selected = "selected";
                                    }
                                    echo "<option value=\"" . $auth['id_opravneni'] . "\" " . $selected . ">" . $auth['nazev'] . "</option>";
                                } ?>
                            </select>
                        </td>
                        <td>
                            <button name="update" type="submit" class="btn btn-outline-success ml-2"><i class="fa fa-check"></i></button>
                        </td>
                        <td>
                            <button name="delete" type="submit" onclick="prompt('Pro smazání napište jméno uživatele')" class="btn btn-outline-danger ml-2"><i class="fa fa-trash"></i></button>
                        </td>
                        </form>
                        <?php } ?>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

<?php } ?>