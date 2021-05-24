<div class="body">
            <h1 class="naslov">Rulet</h1>
            <hr>
            <p>Pravila o ruletu i upustva za koriscenje: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</p>
            <div class="rulet">
                <p >Preostalo vreme: <var id = "vreme"></var> s</p>
                <div  class="rulet_tocak">
                    <img src=<?php echo base_url("slike/rulet_tocak.jpeg");?> alt="rulet tocak">
                </div>
                <div class="interaktivna_tabla">
                    <div class="stanje_tokena">
                        <p>Ukupno tokena: <var id="ukupno_tokena">100</var></p>
                        <p>Ulozeni tokeni: <var>23</var></p>
                        <input type="button" value="Ukloni tokene">
                    </div>
                    <div class="rulet_tabla">
                        <!--   <img src=<?php //echo base_url("slike/rulet_tabla.png");?> alt="rulet tabla"> -->
                        <table style="width: 400px; height: 200px">
                            <tr>
                                <td rowspan="5"> <button>0</button> <p></p> </td>
                                <td> <button>3</button> <p></p> </td>
                                <td> <button>6</button> <p></p> </td>
                                <td> <button>9</button> <p></p> </td>
                                <td> <button>12</button> <p></p> </td>
                                <td> <button>15</button> <p></p></td>
                                <td> <button>18</button> <p></p> </td>
                                <td> <button>21</button> <p></p> </td>
                                <td> <button>24</button> <p></p> </td>
                                <td> <button>27</button> <p></p> </td>
                                <td> <button>30</button> <p></p></td>
                                <td> <button>33</button> <p></p> </td>
                                <td> <button>36</button> <p></p> </td>
                                <td > <button style="width:55px">2 to 1</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td> <button>2</button> <p></p> </td>
                                <td> <button>5</button> <p></p> </td>
                                <td> <button>8</button> <p></p> </td>
                                <td> <button>11</button> <p></p> </td>
                                <td> <button>14</button> <p></p> </td>
                                <td> <button>17</button> <p></p> </td>
                                <td> <button>20</button> <p></p> </td>
                                <td> <button>23</button> <p></p> </td>
                                <td> <button>26</button> <p></p> </td>
                                <td> <button>29</button> <p></p> </td>
                                <td> <button>32</button> <p></p> </td>
                                <td> <button>35</button> <p></p> </td>
                                <td > <button style="width:55px">2 to 1</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td> <button>1</button> <p></p> </td>
                                <td> <button>4</button> <p></p> </td>
                                <td> <button>7</button> <p></p> </td>
                                <td> <button>10</button> <p></p> </td>
                                <td> <button>11</button> <p></p> </td>
                                <td> <button>16</button> <p></p> </td>
                                <td> <button>19</button> <p></p> </td>
                                <td> <button>22</button> <p></p> </td>
                                <td> <button>25</button> <p></p> </td>
                                <td> <button>28</button> <p></p> </td>
                                <td> <button>31</button> <p></p> </td>
                                <td> <button>34</button> <p></p> </td>
                                <td > <button style="width:55px">2 to 1</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td colspan="4"><button>1st12</button> <p></p> </td>
                                <td colspan="4"><button>2nd12</button> <p></p> </td>
                                <td colspan="4"><button>3rd12</button> <p></p> </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button>1 to 18</button> <p></p> </td>
                                <td colspan="2"><button>Even</button> <p></p> </td>
                                <td colspan="2"><button>Red</button> <p></p> </td>
                                <td colspan="2"><button>Black</button> <p></p> </td>
                                <td colspan="2"><button>Odd</button> <p></p> </td>
                                <td colspan="2"><button>19 to 36</button> <p></p> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="izbor_tokena">
                        <h2>Tokeni po kliku:</h2>
                        <div>
                            <input name="token_radio" type="radio" checked>1
                            <input name="token_radio" type="radio">2
                            <input name="token_radio" type="radio">5
                            <input name="token_radio" type="radio">10
                        </div>
                    </div>
                </div>
            </div>
        </div>