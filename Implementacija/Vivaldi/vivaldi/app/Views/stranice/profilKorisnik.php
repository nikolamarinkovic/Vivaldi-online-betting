<div class="body">
            <h1 class="naslov">Profil</h1>
            <hr>
            <div class="profil">
                
                <p>Korisnicko ime: <var><?php echo $korisnik->KorisnickoIme?></var></p>
                <p>Ime: <var><?php echo $korisnik->Ime?></var></p>
                <p>Prezime: <var><?php echo $korisnik->Prezime?></var></p>
                <form action="<?php echo base_url("Korisnik/promenaLozinke")?>" method="POST">
                    <p class="unos"> Promena lozinke: </p><br>
                    <input type="password" placeholder="Stara lozinka" name="stara"><br>
                    <?php $greska=0; if(!empty($errors['stara'])){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php $greska=1;echo $errors['stara']; ?>                     
                       </p>
                    <?php } ?>
                       <?php if((!empty($errors['losaLozinka']))&&(!$greska)){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php echo $errors['losaLozinka']; ?>                     
                       </p>
                    <?php } ?>
                    <input type="password" placeholder="Nova lozinka" name="nova"><br>
                    <?php if(!empty($errors['nova'])){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php echo $errors['nova']; ?>                     
                       </p>
                    <?php } ?>
                    <input type="password" placeholder="Potvrda nove lozinka" name="potvrda"><br>
                    <?php $greska2=0; if(!empty($errors['potvrda'])){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php $greska2=1; echo $errors['potvrda']; ?>                     
                       </p>
                    <?php } ?>
                    <?php if((!empty($errors['poklapanje']))&&($greska2==0)){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php echo $errors['poklapanje']; ?>                     
                       </p>
                    <?php } ?>
                    <?php if((!empty($errors['ista']))&&($greska2==0)){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php echo $errors['ista']; ?>                     
                       </p>
                    <?php } ?>
                       <input type="submit" style="margin-top: 5px; margin-left: 50px">
                       <p style="color: green"><var> <?php if(!empty($uspesno)) echo "Sifra uspesno promenjena!" ?></var></p>
                </form>
                <p>Trenutni tokeni: <var><?php echo $korisnik->Tokeni?></var></p>
                <form action="<?php echo base_url("Korisnik/kupovinaTokena")?>">
                    <p class="unos"> Kupovina tokena: </p>
                    <input type="number" value="100" min="1" name="tokeniKupovina">
                    <?php $flag=0;if(!empty($errors['tokeni'])){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php $flag=1;echo $errors['tokeni']; ?>                     
                       </p>
                    <?php } ?>
                      <?php if((!empty($errors['kolicina']))&&$flag){ ?> 
                       <p style="text-align: left; color: red; margin-top: 0;">
                            <?php echo $errors['kolicina']; ?>                     
                       </p>
                    <?php } ?>
                    <input type="submit">
                    <p style="color: green"><var> <?php if(!empty($uplata)) echo "Tokeni uspesno uplaceni!" ?></var></p>
                </form>
                <form action="<?php echo base_url("Korisnik/prodajaTokena")?>">
                    <p class="unos"> Prodaja tokena: </p>
                    <input type="number" value="100" min="1" name="tokeniProdaja">
                    <input type="submit">
                    <p style="color: green"><var> <?php if(!empty($isplata)) echo "Tokeni uspesno prodati!" ?></var></p>
                <?php if(!empty($errors['minus'])){ ?> 
                    <p style="text-align: left; color: red; margin-top: 0;">
                    <?php echo $errors['minus']; ?>                     
                    </p>
                <?php } ?>
                </form>
                <p>Filter:</p>
                <form class="filter" action="<?php echo base_url("Korisnik/istorijaSubmit")?>" method="GET" style="color: white; font-family: helvetica;">
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