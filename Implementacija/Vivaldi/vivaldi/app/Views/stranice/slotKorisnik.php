<div class="body">
            <h1 class="naslov">Slot masine</h1>
            <hr>
            <p class = "pravila_slot">Pravila o Slot masinama i upustva za koriscenje: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, eveniet? </p>
            <div class="slot">
                <div class = "upper_slot_wrapper">
                    <div class = "slot_tokeni">
                        <form action=""></form>
                        <table>
                            <tr>
                                <td class = "leva_kolona_slot">Tokeni na raspolaganju:</td>
                                <td class = "desna_kolona_slot">50</td>
                            </tr>
                            <tr>
                                <td class = "leva_kolona_slot">Ukupno tokena ulozeno:</td>
                                <td class = "desna_kolona_slot">20</td>
                            </tr>
                            <tr>
                                <td colspan="2" class = "poslednji_red_slot_tokeni"><input type="reset" value="Reset"></td>
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
                                <td><input type="radio" name = "slot_token" value="1" id = "1_token_slot"> <label for="1_token_slot">1</label></td>
                                <td><input type="radio" name = "slot_token" value="1" id = "2_token_slot"> <label for="2_token_slot">2</label></td>
                                <td><input type="radio" name = "slot_token" value="1" id = "5_token_slot"> <label for="5_token_slot">5</label></td>
                                <td><input type="radio" name = "slot_token" value="1" id = "10_token_slot"> <label for="10_token_slot">10</label></td>
                            </tr>
                            <tr>
                                <td colspan="4" class = "poslednji_red_slot_ulog"><input type="button" value="Add"></td>
                            </tr>
    
                        </table>
                        </form>
                    </div>
                </div>
                
                <div class = "slot_bar">
                    <img src=<?php echo base_url("slike/slot_bar.jpg");?> alt="">
                </div>  
                
                <div class = "button_play_slot">
                    <input type="button" value="Spin!">
                </div>

            </div>
        </div>
