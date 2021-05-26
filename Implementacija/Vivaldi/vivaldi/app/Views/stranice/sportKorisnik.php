<?php use App\Models\TimModel;?>  
<div class="body">
            <h1 class="naslov">Sportska kladjenja</h1>
            <hr>
            <p>Pravila Sportskih kladjenja i upustva za korisnika: Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, optio?</p>
            <div class="sport_tiketi">
                <div>
                    <input type="text" placeholder="Pretraga">
                    <table>
                        <tr>
                            <th></th>
                            <th >Utakmica</th>
                            <th style="border-collapse: collapse; ">1</th>
                            <th>X</th>
                            <th>2</th>
                            <th>Datum vreme</th>
                        </tr>
                        <tr>
                            <td><input type="radio" name="izbor"></td>
                            <td>Partizan:Zvezda</td>
                            <td>1.5<input type="radio" name="izbor"></td>
                            <td>2.2<input type="radio" name="izbor"></td>
                            <td>1.7<input type="radio" name="izbor"></td>
                            <td>22/06/2021,14:30 00</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th></th>
                            <th>Utakmica</th>
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
                        echo "<td><input type='Checkbox' name='rbr$utakmica->IdUtakmica'></td>";
                        echo"<td >".$domacin->Ime." : ".$gost->Ime. "</td>";
                        echo"<td style='width: 50px;'>". number_format($utakmica->Kvota1, 1)."<input type='radio' checked name='red$utakmica->IdUtakmica'></td>";
                        echo"<td style='width: 50px;'>". number_format($utakmica->KvotaX, 1)."<input type='radio' name='red$utakmica->IdUtakmica'></td>";
                        echo"<td style='width: 50px;'>". number_format($utakmica->Kvota2, 1)."<input type='radio' name='red$utakmica->IdUtakmica'></td>";
                        echo"<td>".$utakmica->Vreme."</td>"; 
                        $kele=intval($kele);
                        $kele++;
                        echo "</tr>";                     
                 }                   
                }                
                ?>
                    </table>
                </div>
                <form action="<?php echo base_url("Administrator/azurirajKvotu")?>" method="POST">
                    <p>Preostali tokeni: </p>
                    <p><var>1089</var></p>
                    <p>Uplata: </p>
                    <input type="number">
                    <p>Potencijalni dobitak: </p>
                    <p><var>10000</var></p>
                    <input type="submit">
                </form>
            </div>
        </div>