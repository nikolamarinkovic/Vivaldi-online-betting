
<?php

 /*
    Autori:
  *     Marko Lisicic
 */

?>


<div class="body">
            <h1 class="naslov">Profil korisnika</h1>
            <hr>
            <div class="uvid">
                <div>
                    <p>Korisnicko ime: <var><?php echo $korisnik->KorisnickoIme?></var></p>
                    <br>
                    <p>Ime: <var><?php echo $korisnik->Ime?></var></p>
                    <br>
                    <p>Prezime: <var><?php echo $korisnik->Prezime?></var></p>
                    <br>
                    <p>Trenutni tokeni: <var><?php echo $korisnik->Tokeni?></var></p>
                </div>
                
                <p>Filter:</p>
                <form class="filter" action="<?php echo base_url("Administrator/istorijaKorisnikSubmit")?>" method="GET" style="color: white; font-family: helvetica;">
                    <input type="hidden" value="<?php echo $korisnik->IdKorisnik ?>" name="idKor"></input>
                    <input type="checkbox" name="Rulet" value="1" id="Rulet">
                    <label for="Rulet">Rulet</label><br>
                    <input type="checkbox" name="Slot" value="1" id="Slot">
                    <label for="Slot">Slot</label><br>
                    <input type="checkbox" name="Lucky_6" value="1" id="Lucky_6">
                    <label for="Lucky_6">Lucky 6</label><br>
                    <input type="checkbox" name="Sport" value="1" id="Sport">
                    <label for="Sport">Sport</label><br>
                    <input type="submit" style="margin-top: 10px; margin-left: 10px;">
                </form>
                <p style="text-align: center; color: red">
                    <?php if(!empty($errors['nepostojeci'])){
                       echo $errors['nepostojeci'];
                    } ?>
                </p>
                <table>
                    <tr>
                        <th>Tip</th>
                        <th>Ulozeno</th>
                        <th>Osvojeno</th>
                        <th>Opklada</th>
                        <th>Ishod</th>
                    </tr>
                    <?php if(!empty($ruletNiz)){ 
                        foreach($ruletNiz as $rulet){
                            echo '<tr>';
                            
                            echo'<td>Rulet</td>';
                            echo'<td>'.$rulet['ulozeno'].'</td>';
                            echo'<td>'.$rulet['osvojeno'].'</td>';
                            echo'<td>';
                            foreach($rulet['opklada'] as $red){
                                echo $red;
                                echo "<br>";
                            }
                            echo '</td>';
                            echo'<td>'.$rulet['ishod'].'</td>';
                            
                            
                            echo '</tr>';
                        }

                    }
                        if(!empty($slotNiz)){ 
                        foreach($slotNiz as $slot){
                            echo '<tr>';
                            
                            echo'<td>Slot</td>';
                            echo'<td>'.$slot['ulozeno'].'</td>';
                            echo'<td>'.$slot['osvojeno'].'</td>';
                            echo'<td>'.$slot['opklada'].'</td>';
    
                            echo'<td>'.$slot['ishod'].'</td>';
                            
                            
                            echo '</tr>';
                        }

                    }
                        if(!empty($luckyNiz)){ 
                            foreach($luckyNiz as $lucky){
                                echo '<tr>';

                                echo'<td>Lucky 6</td>';
                                echo'<td>'.$lucky['ulozeno'].'</td>';
                                echo'<td>'.$lucky['osvojeno'].'</td>';
                                echo'<td>'.$lucky['opklada'].'</td>';

                                echo'<td>';
                                
                                $brojevi = explode(",", $lucky['ishod']);
                                for($i = 0;$i<17;$i++){
                                    echo $brojevi[$i].", ";
                                }
                                echo '<br>';
                                for($i=17;$i<count($brojevi);$i++){
                                    echo $brojevi[$i];
                                    if($i!=count($brojevi)-1)
                                        echo ", ";
                                }
                                
                                echo '</td>';


                                echo '</tr>';
                            }
                        }
                        if(!empty($sportNiz)){ 
                            foreach($sportNiz as $sport){
                                echo '<tr>';

                                echo'<td>Kladjenje</td>';
                                echo'<td>'.$sport['ulozeno'].'</td>';
                                echo'<td>'.$sport['osvojeno'].'</td>';
                                
                                echo'<td>';
                                foreach($sport['opklada'] as $red){
                                    echo $red;
                                    echo "<br>";
                                }
                                echo '</td>';
                                
                                echo'<td>';
                                foreach($sport['ishod'] as $red){
                                    echo $red;
                                    echo "<br>";
                                }
                                echo '</td>';

                                echo '</tr>';
                            }
                        }
                        
                        
                        
                    ?>
                   
                </table>

  
            </div>
        </div>