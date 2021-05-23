        <div class="body">
            <h1 class="naslov">Dodavanje utakmice</h1>
            <hr>
            <form class="utakmica" action=<?php echo base_url("Administrator/dodajUtakmicu")?> method="POST">
                       
                    
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
                <input type="text" placeholder="1" name="kvota1">
                <?php if(!empty($errors['Kvota1'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Kvota1']; ?>                     
                       </p>
                <?php } ?>
                <h3>Kvota za rezultat X:</h3>
                <input type="text" placeholder="X" name="kvotaX">
                <?php if(!empty($errors['KvotaX'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['KvotaX']; ?>                     
                       </p>
                <?php } ?>
                <h3>Kvota za rezultat 2:</h3>
                <input type="text" placeholder="2" name="kvota2">
                <?php if(!empty($errors['Kvota2'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Kvota2']; ?>                     
                       </p>
                <?php } ?>
                <h3>Vreme:</h3>
                <input type="datetime-local" name="vreme">
                <?php if(!empty($errors['Vreme'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Vreme']; ?>                     
                       </p>
                <?php } ?>
               
                <input type="submit">
                
            </form>
        </div>