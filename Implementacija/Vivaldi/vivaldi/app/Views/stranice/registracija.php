<div class="body">
            <h1 class="naslov">Registracija</h1>
            <hr>
            <form class="registracija" action=<?php echo base_url("Gost/login")?> method="POST">
                <table>
                    <tr>
                        <td class = "leva_kolona"> <p>Korisnicko ime:</p> </td>
                        <td class = "desna_kolona"><input type="text" placeholder="Korisnicko ime" required ></td>
                    </tr>
                    <tr>
                        <td  class = "leva_kolona" > <p>Lozinka:</p></td>
                        <td class = "desna_kolona"><input type="password" placeholder="Lozinka" required></td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona" > <p>Potrvdite lozinku:</p></td>
                        <td class = "desna_kolona"><input type="password" placeholder="Lozinka" required></td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona"> <p>Ime:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="Ime" required></td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona"><p>Prezime:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="Prezime" required></td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona"><p>JMBG:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="JMBG" required></td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona"><p>Broj kartice:</p></td>
                        <td class = "desna_kolona"><input type="text" placeholder="Broj kartice" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="submit_registracija"> <input type="submit"> </td>
                    </tr>

                </table>
               
                
                
                
                
                
                
            </form>
        </div>