<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vivaldi</title>
    <link rel="stylesheet" href="<?php echo base_url("style.css")?>">
    <script src="<?php echo base_url("jquery-3.6.0.min.js")?>"></script>

    
    
    
    
    
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="logo">
                <a href=<?php echo base_url('Korisnik/pocetna');?>>
                    <img src=<?php echo base_url("slike/logo.png");?> alt="logo">
                </a>
            </div>
            <div class="moto">
                <a href="https://www.youtube.com/watch?v=BudvCadi5YA" target="_blank">
                <p class="prvi_red">"Kockar se krije i cuci u svakome od nas...</p>
                <p class="drugi_red">... i ceka pravi cas" - Djordje Balasevic</p>
                </a>
            </div>
            <ul class="reg_pri">
                <li><a href=<?php echo base_url('Korisnik/odjava');?>>Odjava</a></li>
            </ul>

        </div>
        <?php include("meniKorisnik.php");?>
