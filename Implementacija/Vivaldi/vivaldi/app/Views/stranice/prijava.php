<div class="body">
            <h1 class="naslov">Prijava</h1>
            <hr>
            <div class="registracija">
                <form action=<?php echo base_url("Gost/login")?> method="POST">
                    <table>
                        <tr>
                            <td class="leva_kolona">
                                <p>Korisnicko ime*:</p>
                            </td>
                            <td><input type="text" placeholder="Korisnicko ime" name="username_login"></td>
                        </tr>
                        
                        <?php if(!empty($errors['KorisnickoIme'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['KorisnickoIme']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <tr>
                            <td class="leva_kolona">
                                <p>Lozinka*:</p>
                            </td>
                            <td><input type="password" placeholder="Lozinka" name="password_login"></td>
                        </tr>   
                        <?php if(!empty($errors['Lozinka'])){ ?> 
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-top: 10px;">
                                <?php echo $errors['Lozinka']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center;">
                                <input type="submit" value="Prijavi se"  style="margin-top: 20px;">
                            </td>
                        </tr>
                    </table>
             

                </form>
            </div>
        </div>