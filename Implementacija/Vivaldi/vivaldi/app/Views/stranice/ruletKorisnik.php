<div class="body">
            <h1 class="naslov">Rulet</h1>
            <hr>
            <p>Pravila o ruletu i upustva za koriscenje: Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, sapiente.</p>
            <div class="rulet">
                <p>Preostalo vreme: <var>50</var> s</p>
                <div  class="rulet_tocak">
                    <img src=<?php echo base_url("slike/rulet_tocak.jpeg");?> alt="rulet tocak">
                </div>
                <div class="interaktivna_tabla">
                    <div class="stanje_tokena">
                        <p>Prostali tokeni: <var>100</var></p>
                        <p>Ulozeni tokeni: <var>23</var></p>
                        <input type="button" value="Ukloni tokene">
                    </div>
                    <div class="rulet_tabla">
                        <img src=<?php echo base_url("slike/rulet_tabla.png");?> alt="rulet tabla">
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