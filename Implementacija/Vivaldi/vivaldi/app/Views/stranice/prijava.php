<div class="body">
            <h1 class="naslov">Prijava</h1>
            <hr>
            <div class="registracija">
                <form action=<?php echo base_url("Gost/login")?> method="POST">
                    <table>
                        <tr>
                            <td class="leva_kolona"><p>Korisnicko ime*:</p></td>
                            <td><input type="text" placeholder="Korisnicko ime" required></td>
                        </tr>
                        <tr>
                            <td class="leva_kolona"> <p>Lozinka*:</p></td>
                            <td><input type="password" placeholder="Lozinka" required></td>
                        </tr>   
                        <tr>
                            <td class="leva_kolona" colspan="2" style="text-align: center;">
                                <input type="submit" value="Prijavi se"  style="margin-top: 20px;">
                            </td>
                        </tr>
                    </table>
               
                
                    
                </form>
            </div>
        </div>