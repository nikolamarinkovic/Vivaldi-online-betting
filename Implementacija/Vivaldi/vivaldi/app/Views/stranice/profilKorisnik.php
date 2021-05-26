<div class="body">
            <h1 class="naslov">Profil</h1>
            <hr>
            <div class="profil">
                
                <p>Korisnicko ime: <var><?php echo $korisnik->KorisnickoIme?></var></p>
                <p>Ime: <var><?php echo $korisnik->Ime?></var></p>
                <p>Prezime: <var><?php echo $korisnik->Prezime?></var></p>
                <form action="<?php echo base_url("Korisnik/promenaLozinke")?>">
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
                    <input type="submit">
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
                </form>
                <form action="<?php echo base_url("Korisnik/prodajaTokena")?>">
                    <p class="unos"> Prodaja tokena: </p>
                    <input type="number" value="100" min="1" name="tokeniProdaja">
                    <input type="submit">
                <?php if(!empty($errors['minus'])){ ?> 
                    <p style="text-align: left; color: red; margin-top: 0;">
                    <?php echo $errors['minus']; ?>                     
                    </p>
                <?php } ?>
                </form>
                <p>Filter:</p>
                <form class="filter">
                    <input type="checkbox" id="Rulet" value="Rulet">
                    <label for="Rulet">Rulet</label><br>
                    <input type="checkbox" id="Slot" value="Slot">
                    <label for="Slot">Slot</label><br>
                    <input type="checkbox" id="Lucky 6" value="Lucky 6">
                    <label for="Lucky 6">Lucky 6</label><br>
                    <input type="checkbox" id="Sport" value="Sport">
                    <label for="Sport">Sport</label><br>
                </form>
                <table>
                    <tr>
                        <th>Tip</th>
                        <th>Ulozeno</th>
                        <th>Osvojeno</th>
                        <th>Opklada</th>
                        <th>Ishod</th>
                    </tr>
                    <tr>
                        <td>Rulet</td>
                        <td>20</td>
                        <td>0</td>
                        <td>5</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td>Lucky 6</td>
                        <td>20</td>
                        <td>40</td>
                        <td>-</td>
                        <td>7 7 7</td>
                    </tr>
                    <tr>
                        <td>Tiket</td>
                        <td>20</td>
                        <td>0</td>
                        <td>Partizan:Crvena zvezda X</td>
                        <td>Partizan:Crvena zvezda 1</td>
                    </tr>
                </table>
            </div>
        </div>