<?php use App\Models\TimModel;?>  
<div class="body">
            <h1 class="naslov">Sportska kladjenja</h1>
            <hr>
            <p>Pravila Sportskih kladjenja i upustva za korisnika: Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, optio?</p>
            <div class="sport_tiketi">
                <div>
                    
                    <p style="color:red"><?php if(!empty($errors['izbranaBarJednaUtakmica'])) echo $errors['izbranaBarJednaUtakmica']?></p>
                    <table>
                        <tr>
                            <th></th>
                            <th>Utakmica</th>
                            <th>1</th>
                            <th>X</th>
                            <th>2</th>
                            <th>Datum vreme</th>
                        </tr>  
                    <form action="<?php echo base_url("Korisnik/sportSubmit")?>" method="POST">
                <?php if(!empty($utakmice)){        
                    $tm = new TimModel();        
            $numOfGames=0; //kolko redova ima tabela, tj kolko utakmica ima
            $nizUtakmica = []; // niz utakmica, saljemo ovo nazad u bazu, da bismo dohvatali redove preko indeksa,
            
                    foreach($utakmice as $utakmica){   
                        $nizUtakmica[] = $utakmica->IdUtakmica;
                        $domacin = $tm
                            ->where('IdTim', $utakmica->IdDomacin)
                            ->first();
                        $gost = $tm
                            ->where('IdTim', $utakmica->IdGost)
                            ->first();
                        echo "<tr>";
                        echo "<td><input type='Checkbox' name='checkBoxRed$utakmica->IdUtakmica'></td>";
                        echo"<td >".$domacin->Ime." : ".$gost->Ime. "</td>";
                        echo"<td style='width: 50px;'>". number_format($utakmica->Kvota1, 1)."<input type='radio' value = '1' name='radioRed$utakmica->IdUtakmica'></td>";
                        echo"<td style='width: 50px;'>". number_format($utakmica->KvotaX, 1)."<input type='radio' value = 'X' name='radioRed$utakmica->IdUtakmica'></td>";
                        echo"<td style='width: 50px;'>". number_format($utakmica->Kvota2, 1)."<input type='radio' value = '2' name='radioRed$utakmica->IdUtakmica'></td>";
                        echo"<td>".$utakmica->Vreme."</td>"; 
                 
                        $numOfGames++;
                        echo "</tr>";                     
                 }
                 ?>
                    <input type="hidden" value="<?php echo $numOfGames;?>" name="numOfGames">  </input>
                    <input type="hidden" value="<?php echo implode('.',$nizUtakmica);?>" name="nizUtakmica">  </input>
                <?php } 
                ?>
                    </table>
                
                </div>
                
                <div style = "margin-left: 220px">

                    <p>Preostali tokeni: </p>
                    <p><var id="preostali_tokeni"> <?php if(!empty($tokeni)) echo $tokeni; else echo 0; ?> </var></p>
                    <p>Uplata: </p>
                    <input type="number" name = 'uplata'>
                    <p style="color :red; text-align: left"> <?php if(!empty($errors['uplata'])) echo $errors['uplata'] ?></p>
                    <input type="submit" style="margin-top: 10px; margin-left: 50px">
                    <p style="color: green; text-align: center"><var> <?php if(!empty($uspesno)) echo $uspesno ?></var></p>
                    </form>
                </div>
 
            </div>
        </div>