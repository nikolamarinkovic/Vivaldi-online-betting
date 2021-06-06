
<?php

 /*
    Autori:
  *     Marko Lisicic
 */

?>


        <?php use \App\Models\TimModel;?>
<div class="body">
            <h1 class="naslov">Dodavanje utakmice</h1>
            <hr>
            <?php $rang=1; 
            $tm = new TimModel();        
            $timovi = $tm->findAll();
            if($timovi==null){ ?> 
                <p style="text-align: center; color: red; margin-top: 0;">Ne postoji nijedan tim</p>
            <?php }
            else if(count($timovi)<2){ ?> 
                <p style="text-align: center; color: red; margin-top: 0;">Postoji samo jedan tim</p>
            <?php } ?>
            <form class="utakmica" action=<?php echo base_url("Administrator/dodajUtakmicu")?> method="POST">
                 
                <div class="domacin">
                    <h3>Domacin:</h3>
                    <select name="domacin" id="domacin" <?php if($timovi==null||count($timovi)<2){ ?>disabled=""<?php } ?>>
                    <?php foreach($timovi as $tim){ ?> 
                       <option value=<?php echo $tim->IdTim?>><?php echo $tim->Ime?></option>
                    <?php } ?>                        
                </select>
                </div>
                <div class="gost">
                <h3>Gost:</h3>
                
                <select name="gost" id="gost" <?php if($timovi==null||count($timovi)<2){ ?>disabled=""<?php } ?>>
                    <?php foreach($timovi as $tim){ ?> 
                       <option <?php if($rang==2){ ?>selected<?php } ?> value=<?php echo $tim->IdTim?>><?php echo $tim->Ime?></option>
                    <?php $rang++;} ?>                        
                    </select>
                </div>  
                <?php if(!empty($errors['Teams='])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Teams=']; ?>                     
                       </p>
                <?php } ?>
                <h3>Kvota za rezultat 1:</h3>
                <input type="text" placeholder="1" name="kvota1">
                <?php if(!empty($errors['Kvota1'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Kvota1']; ?>                     
                       </p>
                <?php } ?>
                       
                <?php if(!empty($errors['Kvota1-'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Kvota1-']; ?>                     
                       </p>
                <?php } ?>       
                       
                <h3>Kvota za rezultat X:</h3>
                <input type="text" placeholder="X" name="kvotaX">
                <?php if(!empty($errors['KvotaX'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['KvotaX']; ?>                     
                       </p>
                <?php } ?>
                       
                <?php if(!empty($errors['KvotaX-'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['KvotaX-']; ?>                     
                       </p>
                <?php } ?>       
                       
                <h3>Kvota za rezultat 2:</h3>
                <input type="text" placeholder="2" name="kvota2">
                <?php if(!empty($errors['Kvota2'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Kvota2']; ?>                     
                       </p>
                <?php } ?>
                       
                <?php if(!empty($errors['Kvota2-'])){ ?> 
                       <p style="text-align: center; color: red; margin-top: 0;">
                            <?php echo $errors['Kvota2-']; ?>                     
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
                <p style="color: green"><var> <?php if(!empty($uspesno)) echo $uspesno ?></var></p>
                
            </form>
        </div>