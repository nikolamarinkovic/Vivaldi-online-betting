
<link rel="stylesheet" href="<?php echo base_url("slot.css")?>">
<div class="body">
            <h1 class="naslov">Slot masine</h1>
            <hr>
            <p class = "pravila_slot">Pravila o Slot masinama i upustva za koriscenje: Pritisnite polja i postavite zeljeni ulog, nakon toga pritisnite rucku i pokrenite slot. </p>
            <div class="slot">
                <div class = "upper_slot_wrapper">
                    <div class = "slot_tokeni">
                        <form action="">
                        <table>
                            <tr>
                                <td class = "leva_kolona_slot">Tokeni na raspolaganju:</td>
                                <td class = "desna_kolona_slot" id="ukupno_tokena">0</td>
                            </tr>
                            <tr>
                                <td class = "leva_kolona_slot">Ukupno tokena ulozeno:</td>
                                <td class = "desna_kolona_slot" id="ulozeni_tokeni">0</td>
                            </tr>
                            <tr>
                                <td colspan="2" class = "poslednji_red_slot_tokeni">
                                    <input type="button" value="Reset" onclick="resetuj()">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class = "slot_ulog">
                    
                        <table>
                            <tr>
                                <td colspan="4" rowspan="2" class = "prvi_red_slot_ulog"><p>Broj tokena za ulaganje:</p></td>
                            </tr>
                            <tr>

                            </tr>
                            <tr>
                                <td><input type="button" name = "slot_token" value="1" id = "1_token_slot" onclick="dodaj(1)" style = "width:40px;"></td>
                                <td><input type="button" name = "slot_token" value="2" id = "2_token_slot" onclick="dodaj(2)" style = "width:40px;"></td>
                                <td><input type="button" name = "slot_token" value="5" id = "5_token_slot" onclick="dodaj(5)" style = "width:40px;"></td>
                                <td><input type="button" name = "slot_token" value="10" id = "10_token_slot" onclick="dodaj(10)" style = "width:50px;"  ></td>
                            </tr>
    
                        </table>
                        </form>
                    </div>
                </div>
                
                <?php include 'slotMasina.php';?>
                
                <div class = "slot_bar" style="color:white; font-size: 50px; text-align: center;" id="brojevi">
                    _ _ _
                    <!--img src=<//?php echo base_url("slike/slotOff.png");?> alt="slot"-->
                </div>  
                
                <!--div class = "button_play_slot">
                    <input type="button" value="Spin!" onclick="zavrtiMe()">
                </div-->

            </div>
        </div>
