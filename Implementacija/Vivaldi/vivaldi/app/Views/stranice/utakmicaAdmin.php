        <div class="body">
            <h1 class="naslov">Dodavanje utakmice</h1>
            <hr>
            <form class="utakmica">
                <div class="domacin">
                    <h3>Domacin:</h3>
                    <select name="domacin" id="">
                        <option value="Partizan">Partizan</option>
                        <option value="Crvena Zvezda">Crvena Zvezda</option>
                        <option value="Hajduk">Hajduk</option>
                    </select>
                </div>
                <div class="gost">
                <h3>Gost:</h3>
                    <select name="domacin" id="">
                        <option value="Partizan">Partizan</option>
                        <option value="Crvena Zvezda">Crvena Zvezda</option>
                        <option value="Hajduk">Hajduk</option>
                    </select>
                </div>
                <h3>Kvota za rezultat 1:</h3>
                <input type="text" placeholder="1" required>
                <h3>Kvota za rezultat X:</h3>
                <input type="text" placeholder="X" required>
                <h3>Kvota za rezultat 2:</h3>
                <input type="text" placeholder="2" required>
                <h3>Vreme:</h3>
                <input type="datetime-local" required>
                <input type="submit">
            </form>
        </div>