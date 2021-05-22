<div class="body">
            <h1 class="naslov">Registracija</h1>
            <hr>
            <form class="registracija" action=<?php echo base_url("Gost/registration")?> method="POST">
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
                        <td class = "leva_kolona"><p>Broj kartice:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="Broj kartice" name="card_registration"></td>
                    </tr>
                    
                    <?php if(!empty($errors['BrojKartice'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['BrojKartice']; ?>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <tr>
                        <td colspan="2" class="submit_registracija"> <input type="submit"> </td>
                    </tr>

                </table>
               
                
                
                
                
                
                
            </form>
        </div>