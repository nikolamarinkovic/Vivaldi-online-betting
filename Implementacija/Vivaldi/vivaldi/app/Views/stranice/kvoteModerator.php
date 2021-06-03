   <?php use App\Models\UtakmicaModel;
    use App\Models\TimModel;?>    
    <div class="body">
            <h1 class="naslov">Azuriranje kvota</h1>
            <hr>
            <?php 
            $tm = new TimModel();        
            $timovi = $tm->findAll();
            $um = new UtakmicaModel();        
            $utakmice = $um->where("Rezultat","0")->findAll();
            if(empty($utakmice)){ ?> 
                <p style="text-align: center; color: red; margin-top: 0;">Ne postoji nijedna utakmica</p>
            <?php } ?>
            <div class="kvote">
                <form action="<?php echo base_url("Moderator/azurirajKvotu")?>" method="POST">
                    <input type="submit">
                    <p style="color: green"><var> <?php if(!empty($uspesno)) echo "Kvote uspesno promenjene!" ?></var></p>
                    <div class="azuriranje_kvota">
                    <table>
                        <tr>
                            <th style="width: 150px;">Utakmica</th>
                            <th>1</th>
                            <th>X</th>
                            <th>2</th>
                            <th>Datum vreme</th>
                        </tr>    
                <?php if(!empty($utakmice)){        
                    $tm = new TimModel();        
            $timovi = $tm->findAll();
            $kele=1;
                    foreach($utakmice as $utakmica){       
                        $kele=strval($kele);
                        $domacin = $tm
                            ->where('IdTim', $utakmica->IdDomacin)
                            ->first();
                        $gost = $tm
                            ->where('IdTim', $utakmica->IdGost)
                            ->first();
                        echo "<tr>";
                        echo"<td>".$domacin->Ime." : ".$gost->Ime. "</td>";
                        echo"<td style=\"width: 50px;\"><input type=\"number\" name=\"jedan$kele\" value=\"$utakmica->Kvota1\" style=\"width: 50px;\" min=\"1\" step=\"0.1\"></td>";
                        echo"<td style=\"width: 50px;\"><input type=\"number\" name=\"iks$kele\"value=\"$utakmica->KvotaX\" style=\"width: 50px;\" min=\"1\" step=\"0.1\"></td>";
                        echo"<td style=\"width: 50px;\"><input type=\"number\" name=\"dva$kele\"value=\"$utakmica->Kvota2\" style=\"width: 50px;\" min=\"1\" step=\"0.1\"></td>";
                        echo"<td>".$utakmica->Vreme."</td>"; 
                        $kele=intval($kele);
                        $kele++;
                        echo "</tr>";                     
                 }                   
                }                
                ?>
                    </table>
                    </div>
                </form>
            </div>
        </div>