

<div class="body">
            <h1 class="naslov">Lucky 6</h1>
            <hr>
            <p>Pravila Lucky 6 i upustva za korisnika: Izaberite 6 brojeva i unesite uplatu za trenutno kolo pre isteka vremena.</p>
            
            <p style="text-align: center">Preostalo vreme: <var id="vreme">0</var> s</p>
            <div class="polja2">
                <p>Ukupni tokeni:<var id="ukupno_tokena"> <?php if(!empty($Tokeni)) echo $Tokeni?> </var> </p>
            </div>
            <?php include_once 'lucky6.php';?>
            
            
            <!--div class="lucky6">
                <div class="izvucene_kuglice">
                    
                    <table class="tabela1">
                        <tr>
                            <td><var id="izvucen_1"></var><br></td>
                            <td><var id="izvucen_2"></var><br></td>
                            <td><var id="izvucen_3"></var><br></td>
                            <td><var id="izvucen_4"></var><br></td>
                            <td><var id="izvucen_5"></var><br></td>
                        </tr>
                    </table>
                    <table class="tabela2">
                        <tr>
                            <td><var id="izvucen_6"></var><br><p>3400</p></td>
                            <td><var id="izvucen_7"></var><br><p>3300</p></td>
                            <td><var id="izvucen_8"></var><br><p>3200</p></td>
                            <td><var id="izvucen_9"></var><br><p>3100</p></td>
                            <td><var id="izvucen_10"></var><br><p>3000</p></td>
                            <td><var id="izvucen_11"></var><br><p>2900</p></td>
                        </tr>
                        <tr>                          
                            <td><var id="izvucen_12"></var><br><p>2800</p></td>
                            <td><var id="izvucen_13"></var><br><p>2700</p></td>
                            <td><var id="izvucen_14"></var><br><p>2600</p></td>
                            <td><var id="izvucen_15"></var><br><p>2500</p></td>
                            <td><var id="izvucen_16"></var><br><p>2400</p></td>
                            <td><var id="izvucen_17"></var><br><p>2300</p></td>
                        </tr>
                        <tr>          
                            <td><var id="izvucen_18"></var><br><p>2200</p></td>
                            <td><var id="izvucen_19"></var><br><p>2100</p></td>
                            <td><var id="izvucen_20"></var><br><p>2000</p></td>
                            <td><var id="izvucen_21"></var><br><p>1900</p></td>
                            <td><var id="izvucen_22"></var><br><p>1800</p></td>
                            <td><var id="izvucen_23"></var><br><p>1700</p></td>
                        </tr>
                        <tr>
                            <td><var id="izvucen_24"></var><br><p>1600</p></td>
                            <td><var id="izvucen_25"></var><br><p>1500</p></td>
                            <td><var id="izvucen_26"></var><br><p>1400</p></td>
                            <td><var id="izvucen_27"></var><br><p>1300</p></td>
                            <td><var id="izvucen_28"></var><br><p>1200</p></td>
                            <td><var id="izvucen_29"></var><br><p>1100</p></td>
                        </tr>
                        <tr>
                            <td><var id="izvucen_30"></var><br><p>1000</p></td>
                            <td><var id="izvucen_31"></var><br><p>900</p></td>
                            <td><var id="izvucen_32"></var><br><p>800</p></td>
                            <td><var id="izvucen_33"></var><br><p>700</p></td>
                            <td><var id="izvucen_34"></var><br><p>600</p></td>
                            <td><var id="izvucen_35"></var><br><p>500</p></td>
                        </tr>
                    </table>
                </div>
                <div class="uplata">
                    <div class="polja1">
                        <table>
                            <tr>
                                <td>
                                    <p>1. broj:</p>
                                </td>
                                <td class="desna_kolona_lucky6">
                                    <input id="broj_1" type="number" required min="1" max="48">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>2. broj:</p>
                                </td>
                                <td class="desna_kolona_lucky6">
                                    <input id="broj_2" type="number" required min="1" max="48">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>3. broj:</p>
                                </td>
                                <td class="desna_kolona_lucky6">
                                    <input id="broj_3" type="number" required min="1" max="48">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>4. broj:</p>
                                </td>
                                <td class="desna_kolona_lucky6">
                                    <input id="broj_4" type="number" required min="1" max="48">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>5. broj:</p>
                                </td>
                                <td class="desna_kolona_lucky6">
                                    <input id="broj_5" type="number" required min="1" max="48">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>6. broj:</p>
                                </td>
                                <td class="desna_kolona_lucky6">
                                    <input id="broj_6" type="number" required min="1" max="48">
                                </td>
                            </tr>

                        </table>

                    </div>
                    <div class="polja2">
                        <p >Preostali tokeni: </p>
                        <p><var>1089</var></p>
                        <p>Uplata: </p>
                        <input id="ulozeno_tokena" type="number" required>
                    </div>
                </div>
            </div-->
        </div>
