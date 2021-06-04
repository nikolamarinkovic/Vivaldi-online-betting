        <div class="body">
            <h1 class="naslov">Uvid u korisnike</h1>
            <hr>
            <div class="uvid">
                <div>
                    <form action="<?php echo base_url("Administrator/uvidSubmit")?>">
                    <p>Pretraga: </p> 
                    <input type="text" name="username_uvid" placeholder="Unesite korisnicko ime...">
                    <?php if(!empty($errors['usernameUvid'])){ ?> 
                            <br>
                            <p style=" color: red; padding-top: 10px;">
                                <?php echo $errors['usernameUvid']; ?>
                            </p>
                    <?php } ?>
                    <div>
                        <p>Filtriranje: </p>
                        <input type="radio" name="tipKorisnika" id="Administrator_Uvid_korisnik_izbor" value="korisnik"><label for="Administrator_Uvid_korisnik_izbor" style="color: white; font-style: arial">Korisnik</label>
                        <input type="radio" name="tipKorisnika" id="Administrator_Uvid_moderator_izbor" value="moderator"><label for="Administrator_Uvid_moderator_izbor" style="color: white; font-style: arial">Moderator</label>
                        <input type="radio" name="tipKorisnika" id="Administrator_Uvid_administrator_izbor" value="administrator"><label for="Administrator_Uvid_administrator_izbor" style="color: white; font-style: arial">Administrator</label>
                        <?php if(!empty($errors['izabir'])){ ?> 
                            <br>
                            <p style=" color: red; padding-top: 10px;">
                                <?php echo $errors['izabir']; ?>
                            </p>
                        <?php } ?>
                    </div>
                    <div>
                        <p>Sortiranje: </p>
                        <select name="sortiranje" id="">
                            <option value="navise">Navise</option>
                            <option value="nanize">Nanize</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Pretraga" style="margin-left: 150px; margin-top: 10px">
                    </div>
                    </form>
                </div>
                <?php if(!empty($errors['noUser'])){ ?> 
                            <br>
                            <p style=" color: red; padding-top: 10px; padding-bottom: 10px;">
                                <?php echo $errors['noUser']; ?>
                            </p>
                <?php }?>
                <table>
                    <tr>
                        <th>Korisnicko ime</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Broj tokena</th>
                        <th>Tip</th>
                    </tr>
                <?php if(!empty($users)){
                    foreach($users as $korisnik){
                        echo "<tr>";
                        if($uloga == "korisnik")
                            echo"<td><a href = ".base_url("Administrator/istorijaKorisnikSubmit?idKor=".$korisnik->IdKorisnik."&prviPut=1").">".$korisnik->KorisnickoIme."</a></td>";
                        else
                            echo"<td>".$korisnik->KorisnickoIme."</td>";
                        echo"<td>".$korisnik->Ime."</td>";
                        echo"<td>".$korisnik->Prezime."</td>";
                        if($uloga == "korisnik"){
                            echo"<td>".$korisnik->Tokeni."</td>";
                        }
                        else{
                            echo "<td>-</td>";
                        }
                        echo"<td>".$uloga."</td>";

                        echo "</tr>";
                     
                 }
                    
                }
                
                ?>
                 </table>

  
            </div>
        </div>