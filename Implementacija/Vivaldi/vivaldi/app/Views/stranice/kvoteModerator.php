   <?php 
   
 /*
    Autori:
  *     Marko Gloginja
 */
   
    use App\Models\UtakmicaModel;
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
                    <p style="color: green"><var> <?php if(!empty($uspesno)) echo $uspesno ?></var></p>
                    <p style="color: red"><var> <?php if(!empty($errors['neispravna_kvota'])) echo $errors['neispravna_kvota'] ?></var></p>
                    
                    <div class="azuriranje_kvota">
                    <table>
                        <tr>
                            <th style="width: 150px;">Utakmica</th>
                            <th>1</th>
                            <th>X</th>
                            <th>2</th>
                            <th>Datum vreme</th>
                        </tr>    
                <?php 
                    $kele=1;
                    if(!empty($utakmice)){        
                    $tm = new TimModel();        
                    $timovi = $tm->findAll();
            
                    date_default_timezone_set('Europe/Belgrade');
                    $vremeTrenutno = date("Y-m-d\TH:i");
                    foreach($utakmice as $utakmica){
                        $vreme = $utakmica->Vreme; 
                        if(strtotime($vreme) + 60*90 < strtotime($vremeTrenutno))
                            continue;
                        
                        $kele=strval($kele);
                        $domacin = $tm
                            ->where('IdTim', $utakmica->IdDomacin)
                            ->first();
                        $gost = $tm
                            ->where('IdTim', $utakmica->IdGost)
                            ->first();
                        echo "<tr>";
                        echo"<td>"
                                .$domacin->Ime
                                ." : "
                                .$gost->Ime
                                ."<input type=\"hidden\" name=\"utk$kele\" value=\"$utakmica->IdUtakmica\" style=\"width: 50px;\" min=\"1\" step=\"0.1\">"
                                . "</td>";
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
                    <?php 
                        $kele--;
                        echo "<input type=\"hidden\" name=\"ukupno\" value=\"$kele\" style=\"width: 50px;\" min=\"1\" step=\"0.1\">";    
                    ?>
                    </div>
                </form>
            </div>
        </div>