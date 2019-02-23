<?php

    $premiumType = array(
        'EXP Potion' => 1,
        'Third Eye' => 2,
        'Phoenix' => 3,
        'Phoenix Fire' => 4,
        'Phoenix Ice' => 5,
        'Phoenix Lightning' => 6,
        'Phoenix Heal' => 7,
        'MP Down' => 8,
        'SP Down' => 9,
        'HP UP' => 10,
        'MP UP' => 11,
        'Big Head' => 12,
        'Weight Stone' => 13,
        'Mature Stone' => 14,
        'Skill Stone' => 15,
        'Cartola Hat' => 16,
        'Witch Hat' => 17,
        'Sheep Hat' => 18,
        'Giraffe Hat' => 19,
        'Soccer Hat' => 20,
        'XMas Red Hat' => 22,
        'Big Head Happinness' => 23,
        'Big Head Love' => 24,
        'Big Head Sadness' => 25,
        'Big Head Shyness' => 26,
        'Big Head Angry' => 27,
        'Big Head Surprised' => 28,
        'Big Head Sensual' => 29,
        );

    $premiumTime = array(
        '3 Hours' => 60 * 60 * 3,
        '12 Hours' => 60 * 60 * 12,
        '24 Hours' => 60 * 60 * 24,
        '48 Hours' => 60 * 60 * 48,
        '72 Hours' => 60 * 60 * 72,
        );

    //Create SQL Connection with UserDB
    $pSQL = new SQL();
    $pSQL->CreateConnection('UserDB');

    $characterName = Request::get('characterinfo');

    $pHex = new HEX();
    $pHex->readFile(DIR_SERVER.'Login\\Data\\Character\\'.$characterName.'.chr');
	

    $bodyModel = $pHex->getString(0x30,0x40);
    $headModel = $pHex->getString(0x70,0x3C);
    $class = $pHex->getInt(0xC4);
    $level = $pHex->getInt(0xC8);
    $money = $pHex->getInt(0x154);
    $rankup = $pHex->getInt(0x184);

    $pHex->closeFile();

    $check0 = $check1 = $check2 = $check3 = $check4 = "";
    $class1 = $class2 = $class3 = $class4 = $class5 = $class6 = $class7 = $class8 = $class9 = $class10 = "";

    //Get Character Class
    switch ($class)
    {
        case 1:
            $class1 = 'selected="selected"';
            break;
        case 2:
            $class2 = 'selected="selected"';
            break;
        case 3:
            $class3 = 'selected="selected"';
            break;
        case 4:
            $class4 = 'selected="selected"';
            break;
        case 5:
            $class5 = 'selected="selected"';
            break;
        case 6:
            $class6 = 'selected="selected"';
            break;
        case 7:
            $class7 = 'selected="selected"';
            break;
        case 8:
            $class8 = 'selected="selected"';
            break;
        case 9:
            $class9 = 'selected="selected"';
            break;
        case 10:
            $class10 = 'selected="selected"';
            break;
    }

    //Get Rankup
    switch ($rankup)
    {
        case 0:
            $check0 = 'selected="selected"';
            break;
        case 1:
            $check1 = 'selected="selected"';
            break;
        case 2:
            $check2 = 'selected="selected"';
            break;
        case 3:
            $check3 = 'selected="selected"';
            break;
        case 4:
            $check4 = 'selected="selected"';
            break;
    }

    //Header
    echo '<div class="content-wrapper" style="margin-left:0;background:#fff"><section class="content-header"><h1>'.$title.'<small>'.$description.'</small></h1></section>
    <section class="content"><div class="row">';

    //Content
    echo '<div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Edit Character Data</h3></div>
                <div class="box-body">
                <form name=savechar method=post action="?page=user&characterinfo='.$characterName.'&action=save">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="line-height:32px">Character Name</td>
                                <td><input name="chname" class="form-control input-sm" type="text" value="'.$characterName.'"></td>
                            </tr>
                            <tr>
                                <td style="line-height:32px">Head Model</td>
                                <td><input name="headmodel" class="form-control input-sm" type="text" value="'.$headModel.'"></td>
                            </tr>
                            <tr>
                                <td style="line-height:32px">Body Model</td>
                                <td><input name="bodymodel" class="form-control input-sm" type="text" value="'.$bodyModel.'"></td>
                            </tr>
                            <tr>
                                <td style="line-height:32px">Class</td>
                                <td>
                                    <select name="chclass" id="chclass" class="form-control select2" style="width: 100%;">
                                      <option value="1" '.$class1.'>Fighter</option>
                                      <option value="2" '.$class2.'>Mechanician</option>
                                      <option value="3" '.$class3.'>Archer</option>
                                      <option value="4" '.$class4.'>Pikeman</option>
                                      <option value="5" '.$class5.'>Atalanta</option>
                                      <option value="6" '.$class6.'>Knight</option>
                                      <option value="7" '.$class7.'>Magician</option>
                                      <option value="8" '.$class8.'>Priestess</option>
                                      <option value="9" '.$class9.'>Assassin</option>
                                      <option value="10" '.$class10.'>Shaman</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="line-height:32px">Level</td>
                                <td>
                                    <select name="chlvl" id="chlvl" class="form-control select2" style="width: 100%;">';
                                    for($i = 0; $i < 140; $i++)
                                    {
                                        if ( ($i+1) == $level )
                                            echo '<option value="'.($i+1).'" selected="selected">'.($i+1).'</option>';
                                        else
                                            echo '<option value="'.($i+1).'">'.($i+1).'</option>';
                                    }

                                    echo '</select>
                                </td>

                            </tr>
                            <tr>
                                <td style="line-height:32px">Money</td>
                                <td><input name="money" class="form-control input-sm" type="text" value="'.$money.'"></td>
                            </tr>
                            <tr>
                                <td style="line-height:32px">Rankup</td>
                                <td>
                                <select name="rankup" id="rankup" class="form-control select2" style="width: 100%;">
                                  <option value="0" '.$check0.'>Tier 1</option>
                                  <option value="1" '.$check1.'>Tier 2</option>
                                  <option value="2" '.$check2.'>Tier 3</option>
                                  <option value="3" '.$check3.'>Tier 4</option>
                                  <option value="4" '.$check4.'>Tier 5</option>
                                </select>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer"><button type="submit" class="btn btn-primary pull-right">Save</button></div></form>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Edit Premium Data</h3></div>
                <div class="box-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Character Name</th>
                                <th>Item Timer Type</th>
                                <th>Item ID</th>
                                <th>Time Left</th>
                                <th>Time Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';

                        //Get Premium Data
                        if( $pSQL->Prepare('SELECT * FROM CharacterItemTimer WHERE CharacterName=?'))
                        {
                            $pSQL->Execute(array($characterName));

                            while( $pSQL->Fetch() )
                            {
                                $type = $pSQL->GetData('ItemTimerType');
                                $time = $pSQL->GetData('TimeTotal');

                                echo '<form name=savechar method=post action="?page=user&characterinfo='.$characterName.'&action=updatepremium&type='.$type.'&id='.$pSQL->GetData('ItemID').'&left='.$pSQL->GetData('TimeLeft').'&total='.$time.'""><tr>
                                    <td><input name="chname" type="text" class="form-control input-sm" value="'.$pSQL->GetData('CharacterName').'" disabled></input></td>
                                    <td>
                                        <select name="itemtype" style="width:100%">';

                                        foreach ($premiumType as $key => $value) 
                                        {
                                            if( $type == $value )
                                            {
                                                echo '<option value="'.$value.'" selected>'.$key.'</option>';
                                            }
                                            else
                                                echo '<option value="'.$value.'">'.$key.'</option>';
                                        }
                                          
                                        echo '</select>
                                    </td>
                                    <td><input name="itemid" type="text" class="form-control input-sm" value="'.$pSQL->GetData('ItemID').'"></input></td>
                                    <td><input name="timeleft" type="text" class="form-control input-sm" value="'.$pSQL->GetData('TimeLeft').'"></input></td>
                                    <td>
                                        <select name="timetotal" style="width:100%">';

                                        foreach ($premiumTime as $key => $value) 
                                        {
                                            if( $time == $value )
                                            {
                                                echo '<option value="'.$value.'" selected>'.$key.'</option>';
                                            }
                                            else
                                                echo '<option value="'.$value.'">'.$key.'</option>';
                                        }
                                          
                                        echo '</select>
                                    </td>
                                    <td><button type="submit" class="btn btn-normal btn-sm">Save</button> <a href="?page=user&characterinfo='.$characterName.'&action=delete&type='.$type.'&id='.$pSQL->GetData('ItemID').'&left='.$pSQL->GetData('TimeLeft').'&total='.$time.'"><button type="button" class="btn btn-danger btn-sm">Delete</button></a></td>
                                </tr></form>';
                            }

                            echo '<form name=savechar method=post action="?page=user&characterinfo='.$characterName.'&action=insertpremium"><tr>
                                    <td><input name="chname" type="text" class="form-control input-sm" value="'.$characterName.'" disabled></input></td>
                                    <td>
                                        <select name="itemtype" style="width:100%">';

                                        foreach ($premiumType as $key => $value) 
                                            echo '<option value="'.$value.'">'.$key.'</option>';
                                          
                                        echo '</select>
                                    </td>
                                    <td><input name="itemid" type="text" class="form-control input-sm" placeholder="Insert a Item ID"></input></td>
                                    <td><input name="timeleft" type="text" class="form-control input-sm" placeholder="Time Left (leave empty if want same the total time)"></input></td>
                                    <td>
                                        <select name="timetotal" style="width:100%">';

                                        foreach ($premiumTime as $key => $value) 
                                            echo '<option value="'.$value.'">'.$key.'</option>';
                                          
                                        echo '</select>
                                    </td>
                                    <td><button type="submit" class="btn btn-success btn-sm">Insert</button></td>
                                </tr></form>';
                        }

                  echo '</tbody>
                    </table>                 
                </div>
            </div>

        </div>';

    //End
    echo'</div></section></div>';

?>