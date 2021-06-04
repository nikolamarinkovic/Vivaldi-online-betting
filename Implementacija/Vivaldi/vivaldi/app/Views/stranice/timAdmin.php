        <div class="body">
            <h1 class="naslov">Dodavanje tima</h1>
            <hr>
            <form class="dodavanje_tima" action=<?php echo base_url("Administrator/dodajTim")?> method="POST">
                <table>
                    <tr>
                        <td class = "leva_kolona_tim">
                            <p>Ime Tima: </p>
                        </td>
                        <td class = "desna_kolona_tim">
                            <input type="text" placeholder="Ime tima"  name="tim_ime">
                        </td>
                    </tr>
                    <?php if(!empty($errors['TimIme'])){ ?> 
                    <tr>
                        <td class="leva_kolona" colspan="2" style="text-align: center; color: red; padding-bottom: 15px;">
                            <?php echo $errors['TimIme']; ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2" class = "submit_tim">
                            <input type="submit">
                            <p style="color: green; margin-left: 100px"> <?php if(!empty($uspeh)) echo $uspeh?></p>
                        </td>
                    </tr>
                </table>
                
                
            </form>
        </div>