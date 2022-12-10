<?php

global $dataFetch;
global $queryResult;

if(mySession::isSet('uroven') && mySession::get('uroven') >= 3){?>
    <div class="container">
        <div class="card table-responsive">
            <div class="card-body">
                <h5 class="card-title mb-0">Spravovat uživatele</h5>
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
        }
    } ?>

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
                            <button name="update" type="submit" class="btn btn-outline-success ml-2 w-40px"><i class="fa fa-check"></i></button>
                        </td>
                        <td>
                            <button name="delete" onclick="return confirm('Opravdu chcete smazat uživatele <?= $res['jmeno'] ?>?')" type="submit" class="btn btn-outline-danger ml-2 w-40px"><i class="fa fa-trash"></i></button>
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