
<?php

 /*
    Autori:
  *     Marko Gloginja
 */

?>



<script src="<?php echo base_url("skripta_lucky6.js")?>"></script>

<div class="body">
            <h1 class="naslov">Lucky 6</h1>
            <hr>
            <p style="text-align: center; margin-top: 0px;">Izaberite 6 brojeva i unesite uplatu za trenutno kolo pre isteka vremena.</p>
            <hr>
            <p style="text-align: center">Preostalo vreme: <var id="vreme">50</var> s</p>
            <div class="polja2">
                <p>Ukupni tokeni:<var id="ukupno_tokena"> <?php if(!empty($Tokeni)) echo $Tokeni; else echo '0';?> </var> </p>
            </div>
            
            <?php include_once 'lucky6.php';?>
            <div class="infoTokeni"></div>
            <script src=<?php echo base_url("lucky6.js")?>></script>
            
        </div>
