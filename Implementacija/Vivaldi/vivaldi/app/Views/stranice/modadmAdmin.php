        <div class="body">
            <h1 class="naslov">Dodavanje moderatora/administratora</h1>
            <hr>
            <form class="registracija" action=<?php echo base_url("Administrator/dodavanjeZaposlenog")?> method="POST">
                <table>
                    <tr>
                        <td class = "leva_kolona"> <p>Korisnicko ime:</p> </td>
                        <td class = "desna_kolona"><input type="text" placeholder="Korisnicko ime" name="username_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['KorisnickoIme'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['KorisnickoIme']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                        
                    <tr>
                        <td  class = "leva_kolona" > <p>Lozinka:</p></td>
                        <td class = "desna_kolona"><input type="password" placeholder="Lozinka" name="password_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['Lozinka'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['Lozinka']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                    
                        
                    <?php if(!empty($errors['LozinkeNisuIste'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['LozinkeNisuIste']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class = "leva_kolona" > <p>Potrvdite lozinku:</p></td>
                        <td class = "desna_kolona"><input type="password" placeholder="Potvrda lozinke" name="passconfirm_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['PotvrdaLozinke'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['PotvrdaLozinke']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                        
                    <tr>
                        <td class = "leva_kolona"> <p>Ime:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="Ime" name="name_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['Ime'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['Ime']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <tr>
                        <td class = "leva_kolona"><p>Prezime:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="Prezime" name="surname_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['Prezime'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['Prezime']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class = "leva_kolona"><p>JMBG:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="JMBG" name="id_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['JMBG'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['JMBG']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td class = "leva_kolona"><p>Tip:</p></td>
                        <td class = "desna_kolona">
                            <input name="type" type="radio" value="Moderator" id="radioMod"> <label for="radioMod">Moderator</label> 
                            <input name="type" type="radio" value="Administrator" id="radioAdm"><label for="radioAdm">Administrator</label> 
                        </td>
                    </tr>
                    <?php if(!empty($errors['Tip'])){ ?> 
                    <tr>
                        <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                            <?php echo $errors['Tip']; ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2" class="submit_registracija"> <input type="submit"> </td>
                    </tr>
                    <p style="color: green"><var> <?php if(!empty($uspesno)) echo $uspesno ?></var></p>

                </table>
            </form>
            
            
        </div>