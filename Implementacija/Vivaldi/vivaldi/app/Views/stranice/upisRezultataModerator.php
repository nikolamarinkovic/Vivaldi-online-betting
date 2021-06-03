<?php use App\Models\TimModel;?>          
        <div class="body">
            <h1 class="naslov">Upis rezultata utakmice</h1>
            <hr>

                <div class="sport_tiketi">
                <div>
                    <p style="color:red"><?php if(!empty($errors['izbranaBarJednaUtakmica'])) echo $errors['izbranaBarJednaUtakmica']?></p>
                    <p style="color: green"><var> <?php if(!empty($uspesno)) echo $uspesno ?></var></p>
                    <table>
                        <tr>
                            <th></th>
                            <th>Utakmica</th>
                            <th>1</th>
                            <th>X</th>
                            <th>2</th>
                            <th>Datum vreme</th>
                        </tr>  
                    <form action="<?php echo base_url("Moderator/submitRezultat")?>" method="POST">
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
                        echo"<td style='width: 50px;'><input type='radio' value = '1' name='radioRed$utakmica->IdUtakmica'></td>";
                        echo"<td style='width: 50px;'><input type='radio' value = 'X' name='radioRed$utakmica->IdUtakmica'></td>";
                        echo"<td style='width: 50px;'><input type='radio' value = '2' name='radioRed$utakmica->IdUtakmica'></td>";
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
                
                <div style = "margin-left: 285px; margin-top: 76px;">

                    <input type="submit" style="width: 100px;height: 30px">
                    </form>
                </div>
 
            </div>
            
            
        </div>