/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function resetuj(){
    console.log("test");
    document.getElementById("ulozeni_tokeni").innerHTML = 0;
}

function dodaj(broj){
    tokeni = parseInt(document.getElementById("ulozeni_tokeni").innerHTML);
    delta = broj;
    max = parseInt(document.getElementById("ukupno_tokena").innerHTML);
    if(tokeni + delta > max)
        tokeni = max
    else
        tokeni += delta;
    document.getElementById("ulozeni_tokeni").innerHTML = tokeni
}

function zavrtiMe(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        res = this.responseText.split(",");
        document.getElementById("ukupno_tokena").innerHTML = res[3];
        
        
        //document.getElementById("brojevi").innerHTML =res[0] + " " + res[1] + " " + res[2];
        this.responseText;
        
    }
    };
    xhttp.open("POST", "http://localhost:8080/Korisnik/spin" , true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var params = 'Tokeni='+document.getElementById("ulozeni_tokeni").innerHTML;
    document.getElementById("ulozeni_tokeni").innerHTML = 0;
    xhttp.send(params);
}