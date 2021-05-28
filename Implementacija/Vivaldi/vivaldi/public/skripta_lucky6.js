//vreme = 10;
//$(document).ready(function(){
//    //("#ulozeno_tokena").text(0)
//    vreme = 10;
//    $("#vreme").text(vreme);
//    $("button").click(function(){
//        sibling = $(this).next();
//        if(sibling.text() == "")
//            sibling.text(1);
//        else{
//            i = sibling.text();
//            i = parseInt(i) + 1;
//            sibling.text(i);
//        }
//        if($("#ulozeno_tokena").text() == ""){
//            ulozeni = 1
//        }
//        else{
//            ulozeni = parseInt($("#ulozeno_tokena").text()) + 1;
//        }
//        $("#ulozeno_tokena").text(ulozeni)
//    
//    })
//    setInterval(function(){
//        vreme--;
//        $("#vreme").text(vreme);
//        if(vreme == 0){
//            for(i = 1; i <= 35; i++){
//                    $("izvucen_" + i).text("")
//                }
//            
//            brojevi = ""
//            for(i = 1; i <= 6; i++){
//                brojevi += $("#broj_"+i).val() + ","
//            }
//            brojevi += $("#ulozeno_tokena").val()
//                       
//            console.log(brojevi)
//           
//            vreme = 10;
//            $("#vreme").text(vreme);
//            
//            //ajax
//            
//            var xhttp = new XMLHttpRequest();
//            xhttp.onreadystatechange = function() {
//            if (this.readyState == 4 && this.status == 200) {
//                niz = this.responseText.split(",");
//                for(i = 1; i <= 35; i++){
//                    $("izvucen_" + i).text(niz[i])
//                }
//                tokeni = niz[36];
//                document.getElementById("ukupno_tokena").innerHTML = tokeni;
//                document.getElementById("ulozeno_tokena").innerHTML = "0";
//                console.log(this.responseText);
//                vreme = 10;
//                $("#vreme").text(vreme);
//                
//                
//            }
//            };
//            xhttp.open("POST", "http://localhost:8080/Korisnik/lucky6_drawing" , true);
//            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//            var params = 'niz='+brojevi;
//            xhttp.send(params);
//            
//        }
//       
//        
//    }
//    ,1000)
//        
//})