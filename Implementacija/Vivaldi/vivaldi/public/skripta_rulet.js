vreme = 30;

$(document).ready(function(){
    let info = document.querySelector('.info');
    //("#ulozeno_tokena").text(0)
    vreme = 30;
    $("#vreme").text(vreme);
    $("#tabla button").click(function(){
        if($("#ulozeno_tokena").text() === $("#ukupno_tokena").text()){
            return
        }
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
    $("#ukloni").click(function(){
        tokeni = $("#ulozeno_tokena");
        tokeni.text("0");
        dugmici = $("#tabla button");
        dugmici.next().text("");
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
            vreme = 30;
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
                vreme = 30;
                $("#vreme").text(vreme);
                
                $("#tabla button").next().text("")
                
                dobitak = parseInt(niz[2]);
                if(dobitak > 0){
                    info.innerHTML = 'Cestitamo! Pao je broj ' + broj + '! Pogodili ste i osvojili ' + dobitak + ' tokena';
                    info.style.background = '#1CC31C';
                    info.style.color = '#DDDDDD';
                    info.style.display = 'block';
                }
                else if(dobitak == 0){
                    info.innerHTML = 'Pao je broj ' +broj + '. Niste pogodili.';
                    info.style.background = 'tomato';
                    info.style.color = '#fff';
                    info.style.display = 'block';
                }
                else if(dobitak == -1){
                    info.innerHTML = 'Ulozite tokene da biste poceli igru.';
                    info.style.background = 'tomato';
                    info.style.color = '#fff';
                    info.style.display = 'block';
                    }
                
                setTimeout(function(){
                    info.style.display = 'none'
                },5000)
               
                
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