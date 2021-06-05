<div class="body">
            <h1 class="naslov">Rulet</h1>
            <hr>
            <p style="text-align: center; margin-top: 0px;">Pritisnite polje da biste dodali po 1 token na dato polje.Nakon 30 sekundi pocinje igra sa Vasim ulogom.</p>
            <hr>
            <div class="rulet">
                <p >Preostalo vreme: <var id = "vreme"></var>0s</p>
                <div  class="rulet_tocak">
                    <img src=<?php echo base_url("slike/rulet_tocak.jpeg");?> alt="rulet tocak">
                </div>
                <div class="interaktivna_tabla">
                    <div class="stanje_tokena">
                        <p>Ukupno tokena: <var id="ukupno_tokena"><?php if(!empty($tokeni)) echo $tokeni?></var></p>
                        <p>Ulozeni tokeni: <var id="ulozeno_tokena">0</var></p>
                        <input type="button" value="Ukloni tokene">
                    </div>
                    <div class="rulet_tabla" id="tabla">
                        <!--   <img src=<?php //echo base_url("slike/rulet_tabla.png");?> alt="rulet tabla"> -->
                        <table id="ruletBoja" style="width: 400px; height: 200px; background-color : green;">
                            <tr>
                                <td rowspan="5"> <button class="green">0</button> <p></p> </td>
                                <td> <button class="red">3</button> <p></p> </td>
                                <td> <button class="black">6</button> <p></p> </td>
                                <td> <button class="red">9</button> <p></p> </td>
                                <td> <button class="red">12</button> <p></p> </td>
                                <td> <button class="black">15</button> <p></p></td>
                                <td> <button class="red">18</button> <p></p> </td>
                                <td> <button class="red">21</button> <p></p> </td>
                                <td> <button class="black">24</button> <p></p> </td>
                                <td> <button class="red">27</button> <p></p> </td>
                                <td> <button class="red">30</button> <p></p></td>
                                <td> <button class="black">33</button> <p></p> </td>
                                <td> <button class="red">36</button> <p></p> </td>
                                <td > <button style="width:55px" class="green">2 to 1 a</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td> <button class="black">2</button> <p></p> </td>
                                <td> <button class="red">5</button> <p></p> </td>
                                <td> <button class="black">8</button> <p></p> </td>
                                <td> <button class="black">11</button> <p></p> </td>
                                <td> <button class="red">14</button> <p></p> </td>
                                <td> <button class="black">17</button> <p></p> </td>
                                <td> <button class="black">20</button> <p></p> </td>
                                <td> <button class="red">23</button> <p></p> </td>
                                <td> <button class="black">26</button> <p></p> </td>
                                <td> <button class="black">29</button> <p></p> </td>
                                <td> <button class="red">32</button> <p></p> </td>
                                <td> <button class="black">35</button> <p></p> </td>
                                <td > <button style="width:55px" class="green">2 to 1 b</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td> <button class="red">1</button> <p></p> </td>
                                <td> <button class="black">4</button> <p></p> </td>
                                <td> <button class="red">7</button> <p></p> </td>
                                <td> <button class="black">10</button> <p></p> </td>
                                <td> <button class="black">13</button> <p></p> </td>
                                <td> <button class="red">16</button> <p></p> </td>
                                <td> <button class="red">19</button> <p></p> </td>
                                <td> <button class="black">22</button> <p></p> </td>
                                <td> <button class="red">25</button> <p></p> </td>
                                <td> <button class="black">28</button> <p></p> </td>
                                <td> <button class="black">31</button> <p></p> </td>
                                <td> <button class="red">34</button> <p></p> </td>
                                <td > <button style="width:55px" class="green">2 to 1 c</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td colspan="4"><button class="green">1st12</button> <p></p> </td>
                                <td colspan="4"><button class="green">2nd12</button> <p></p> </td>
                                <td colspan="4"><button class="green">3rd12</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button class="green">1 to 18</button> <p></p> </td>
                                <td colspan="2"><button class="green">Even</button> <p></p> </td>
                                <td colspan="2"><button class="red">Red</button> <p></p> </td>
                                <td colspan="2"><button class="black">Black</button> <p></p> </td>
                                <td colspan="2"><button class="green">Odd</button> <p></p> </td>
                                <td colspan="2"><button class="green">19 to 36</button> <p></p> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="izbor_tokena">
<!--                        <h2>Tokeni po kliku:</h2>
                        <div>
                            <input name="token_radio" type="radio" checked>1
                            <input name="token_radio" type="radio">2
                            <input name="token_radio" type="radio">5
                            <input name="token_radio" type="radio">10
                        </div>-->
                    </div>
                </div>
            </div>
        </div>