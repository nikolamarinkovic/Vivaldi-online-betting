        <div class="body">
            <h1 class="naslov">Profil</h1>
            <hr>
            <div class="profil">
                <p>Korisnicko ime: <var><?php echo $zaposlen->KorisnickoIme?></var></p>
                <p>Ime: <var><?php echo $zaposlen->Ime?></var></p>
                <p>Prezime: <var><?php echo $zaposlen->Prezime?></var></p>
                <form action="<?php echo base_url("Moderator/promenaLozinke")?>">
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
                    <input type="submit" style="margin-top: 5px; margin-left: 50px">
                       <p style="color: green"><var> <?php if(!empty($uspesno)) echo "Sifra uspesno promenjena!" ?></var></p>
                </form>
            </div>
        </div>