<script src="<?php echo base_url("jquery-3.6.0.min.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("slot.css")?>">
<script src="<?php echo base_url("slot.js")?>"></script>
<div class="body">
            <h1 class="naslov">Slot masine</h1>
            <hr>
            <p class = "pravila_slot">Pravila o Slot masinama i upustva za koriscenje: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, eveniet? </p>
            <div class="slot">
                <div class = "upper_slot_wrapper">
                    <div class = "slot_tokeni">
                        <form action="">
                        <table>
                            <tr>
                                <td class = "leva_kolona_slot">Tokeni na raspolaganju:</td>
                                <td class = "desna_kolona_slot" id="ukupno_tokena"><?php echo $Tokeni?></td>
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
                                <td><input type="radio" name = "slot_token" value="1" id = "1_token_slot" checked> <label for="1_token_slot">1</label></td>
                                <td><input type="radio" name = "slot_token" value="2" id = "2_token_slot"> <label for="2_token_slot">2</label></td>
                                <td><input type="radio" name = "slot_token" value="5" id = "5_token_slot"> <label for="5_token_slot">5</label></td>
                                <td><input type="radio" name = "slot_token" value="10" id = "10_token_slot"> <label for="10_token_slot">10</label></td>
                            </tr>
                            <tr>
                                <td colspan="4" class = "poslednji_red_slot_ulog">
                                    <input type="button" value="Add" onclick="dodaj()">
                                </td>
                            </tr>
    
                        </table>
                        </form>
                    </div>
                </div>
                
                <?php include 'slot.html';?>
                
                <div class = "slot_bar" style="color:white; font-size: 50px; text-align: center;" id="brojevi">
                    _ _ _
                    <!--img src=<//?php echo base_url("slike/slotOff.png");?> alt="slot"-->
                </div>  
                
                <div class = "button_play_slot">
                    <input type="button" value="Spin!" onclick="zavrtiMe()">
                </div>

            </div>
        </div>
