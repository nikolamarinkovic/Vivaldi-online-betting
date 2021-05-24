vreme = 15;
$(document).ready(function(){
    vreme = 15;
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
    })
    setInterval(function(){
        vreme--;
        $("#vreme").text(vreme);
        if(vreme == 0){
            dugmici = $("button");
            niz = [];
            for(let i = 0; i<dugmici.length;i++){
                dugme =dugmici.eq(i);
                broj = dugme.text();
                if(broj != 'Ukloni tokene')
                    niz[broj] = dugme.next().text();  
            }
           
            s = "";
            i = 0;
            n = niz.length;
            for(var kljuc in niz){
                if(niz[kljuc] == null || niz[kljuc] == '')
                    s+=kljuc + ","+ 0;
                else
                    s += kljuc + ","+ niz[kljuc];
                if(i != n - 2){
                    s+="#"
                }
                i++;
            }
            console.log(s);
            vreme = 15;
            $("#vreme").text(vreme);
            
            //ajax
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                niz = this.responseText.split(",");
                broj = niz[0];
                tokeni = niz[1];
                document.getElementById("ukupno_tokena").innerHTML = tokeni;
                this.responseText;
                vreme = 15;
                $("#vreme").text(vreme);
                
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