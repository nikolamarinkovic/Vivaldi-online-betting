vreme = 5;
$(document).ready(function(){
    //("#ulozeno_tokena").text(0)
    vreme = 5;
    $("#vreme").text(vreme);
    $("button").click(function(){
        sibling = $(this).next();
        if(sibling.text() == "")
            sibling.text(1);
        else{
            i = sibling.text();
            i = parseInt(i) + 1;
            sibling.text(i);
        }
        if($("#ulozeno_tokena").text() == ""){
            ulozeni = 1
        }
        else{
            ulozeni = parseInt($("#ulozeno_tokena").text()) + 1;
        }
        $("#ulozeno_tokena").text(ulozeni)
    
    })
    setInterval(function(){
        vreme--;
        $("#vreme").text(vreme);
        if(vreme == 0){
            dugmici = $("#tabla button");
            niz = [];
            for(let i = 0; i<dugmici.length;i++){
                dugme =dugmici.eq(i);
                broj = dugme.text();
                if(dugme.next().text() != '')
                    niz[broj] = dugme.next().text();
                else
                    niz[broj] = '0';
            }
           
            s = "";
            i = 0;
            n = niz.length;
            for(var kljuc in niz){
                s += kljuc + ":"+ niz[kljuc];
                    s+=","
            }
            s = s.substr(0, s.length - 1)
            console.log(s);
            vreme = 5;
            $("#vreme").text(vreme);
            
            //ajax
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                niz = this.responseText.split(",");
                broj = niz[0];
                tokeni = niz[1];
                document.getElementById("ukupno_tokena").innerHTML = tokeni;
                document.getElementById("ulozeno_tokena").innerHTML = "0";
                console.log(this.responseText);
                vreme = 5;
                $("#vreme").text(vreme);
                
                $("#tabla button").next().text("")
               
                
            }
            };
            xhttp.open("POST", "http://localhost:8080/Korisnik/rulet_spin" , true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            var params = 'niz='+s;
            xhttp.send(params);
            
        }
       
        
    }
    ,1000)
        
})