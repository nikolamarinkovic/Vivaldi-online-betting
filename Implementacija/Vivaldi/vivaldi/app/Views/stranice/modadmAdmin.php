        <div class="body">
            <h1 class="naslov">Dodavanje moderatora/administratora</h1>
            <hr>
            <form class="dod_mod_amd" action="pocetna_korisnik.html">
                <table>
                    <tr>
                        <td class = "leva_kolona_mod_adm">
                            <p>Korisnicko ime:</p>
                        </td>
                        <td class = "desna_kolona_mod_adm">
                            <input type="text" placeholder="Korisnicko ime" required>
                        </td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona_mod_adm">
                            <p>Lozinka:</p>
                        </td>
                        <td class = "desna_kolona_mod_adm">
                            <input type="password" placeholder="Lozinka" required>
                        </td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona_mod_adm">
                            <p>Potvrdite lozinku:</p>
                        </td>
                        <td class = "desna_kolona_mod_adm">
                            <input type="password" placeholder="Potvrdite lozinku" required>
                        </td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona_mod_adm">
                            <p>Ime:</p>
                        </td>
                        <td class = "desna_kolona_mod_adm">
                            <input type="text" placeholder="Ime" required>
                        </td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona_mod_adm">
                            <p>Prezime:</p>
                        </td>
                        <td class = "desna_kolona_mod_adm">
                            <input type="text" placeholder="Prezime" required>
                        </td>
                    </tr>
                    <tr>
                        <td class = "leva_kolona_mod_adm">
                            <p>JMBG:</p>
                        </td>
                        <td class = "desna_kolona_mod_adm">
                            <input type="text" placeholder="JMBG" required>
                        </td>
                    </tr>
                </table>
                <div>
                    Tip:
                    <input name="vrsta" type="radio" checked>Moderator
                    <input name="vrsta" type="radio">Administrator
                </div>
                <input type="submit">
            </form>
        </div>