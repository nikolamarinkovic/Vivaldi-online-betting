<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \App\Models\KorisnikModel;
use \App\Models\TiketSlotModel;
use \App\Models\RuletModel;
use \App\Models\TiketRuletModel;
use \App\Models\StavkaRuletModel;

/**
 * Description of Korisnik
 *
 * @author Marko
 */
class Korisnik extends BaseController{
    //put your code here
    
    protected function prikaz($page, $data) {
        $data['controller']='Korisnik';
        echo view('sablon/header_korisnik');
        echo view ("stranice/meniKorisnik");
        echo view ("stranice/$page", $data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetna',[]);
    }
    public function pocetna(){
        $this->prikaz('pocetna',[]);
    }
    
    public function odjava(){  
        $this->session->destroy();
        return redirect()->to(base_url('/'));

    }
    
    public function rulet(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $this->prikaz('ruletKorisnik',['tokeni' => $Korisnik->Tokeni]);
    }
    
    public function rulet_spin(){
        $handlers = [
            '0' => function($num){
                return  $num == 0 ? 35 : 0;
            },
            '1' => function($num){
                return  $num == 1 ? 35 : 0;
            },
            '2' => function($num){
                return  $num == 2 ? 35 : 0;
            },
            '3' => function($num){
                return  $num == 3 ? 35 : 0;
            },
            '4' => function($num){
                return  $num == 4 ? 35 : 0;
            },
            '5' => function($num){
                return  $num == 5 ? 35 : 0;
            },
            '6' => function($num){
                return  $num == 6 ? 35 : 0;
            },
            '7' => function($num){
                return  $num == 7 ? 35 : 0;
            },
            '8' => function($num){
                return  $num == 8 ? 35 : 0;
            },
            '9' => function($num){
                return  $num == 9 ? 35 : 0;
            },
            '10' => function($num){
                return  $num == 10 ? 35 : 0;
            },
            '11' => function($num){
                return  $num == 11 ? 35 : 0;
            },
            '12' => function($num){
                return  $num == 12 ? 35 : 0;
            },
            '13' => function($num){
                return  $num == 13 ? 35 : 0;
            },
            '14' => function($num){
                return  $num == 14 ? 35 : 0;
            },
            '15' => function($num){
                return  $num == 15 ? 35 : 0;
            },
            '16' => function($num){
                return  $num == 16 ? 35 : 0;
            },
            '17' => function($num){
                return  $num == 17 ? 35 : 0;
            },
            '18' => function($num){
                return  $num == 18 ? 35 : 0;
            },
            '19' => function($num){
                return  $num == 19 ? 35 : 0;
            },
            '20' => function($num){
                return  $num == 20 ? 35 : 0;
            },
            '21' => function($num){
                return  $num == 21 ? 35 : 0;
            },
            '22' => function($num){
                return  $num == 22 ? 35 : 0;
            },
            '23' => function($num){
                return  $num == 23 ? 35 : 0;
            },
            '24' => function($num){
                return  $num == 24 ? 35 : 0;
            },
            '25' => function($num){
                return  $num == 25 ? 35 : 0;
            },
            '26' => function($num){
                return  $num == 26 ? 35 : 0;
            },
            '27' => function($num){
                return  $num == 27 ? 35 : 0;
            },
            '28' => function($num){
                return  $num == 28 ? 35 : 0;
            },
            '29' => function($num){
                return  $num == 29 ? 35 : 0;
            },
            '30' => function($num){
                return  $num == 30 ? 35 : 0;
            },
            '31' => function($num){
                return  $num == 31 ? 35 : 0;
            },
            '32' => function($num){
                return  $num == 32 ? 35 : 0;
            },
            '33' => function($num){
                return  $num == 33 ? 35 : 0;
            },
            '34' => function($num){
                return  $num == 34 ? 35 : 0;
            },
            '35' => function($num){
                return  $num == 35 ? 35 : 0;
            },
            '36' => function($num){
                return  $num == 36 ? 35 : 0;
            },
            '2 to 1 a' => function($num){
                return in_array($num, [3 , 6 , 9 , 12,
                                       15, 18, 21, 24,
                                       27, 30, 33, 36]) ? 35 : 0;
            },
            '2 to 1 b' => function($num){
                return in_array($num, [2 , 5 , 8 , 11,
                                       14, 17, 20, 23,
                                       26, 29, 32, 35]) ? 35 : 0;
            },
            '2 to 1 c' => function($num){
                return in_array($num, [1 , 4 , 7 , 10,
                                       13, 16, 19, 22,
                                       25, 28, 31, 34]) ? 35 : 0;
            },
            '1st12' => function($num){
                return  (1 <= $num && $num <=12) ? 35 : 0;
            },
            '2nd12' => function($num){
                return  (13 <= $num && $num <=24) ? 35 : 0;
            },
            '3rd12' => function($num){
                return  (25 <= $num && $num <=36) ? 35 : 0;
            },
            '1 to 18' => function($num){
                return  (1 <= $num && $num <=18) ? 35 : 0;
            },
            'Even' => function($num){
                return  ($num % 2 == 0) ? 2 : 0;
            },
            'Red' => function($num){
                return in_array($num, [1 , 3 , 5 , 7,
                                       9 , 12, 14, 16,
                                       18, 19, 21, 23,
                                       25, 27, 30, 32,
                                       34, 36]) ? 2 : 0;
            },
            'Black' => function($num){
                return in_array($num, [2 , 4 , 6 , 8,
                                       10, 11, 13, 15,
                                       17, 20, 22, 24,
                                       26, 28, 29, 31,
                                       33, 35]) ? 2 : 0;
            },
            'Odd' => function($num){
                return  ($num % 2 == 1) ? 2 : 0;
            },
            '19 to 36' => function($num){
                return  (19 <= $num && $num <=36) ? 2 : 0;
            }
        ];
        
        
        $rulet = [];
        
        $niz = $this->request->getVar('niz');
        $kvs = explode(',', $niz);
        
        $ulog = 0;
        
        foreach($kvs as $kv){
            $tmp = explode(':', $kv);
            $rulet[$tmp[0]] = intval($tmp[1]);
            $ulog += intval($tmp[1]);
        }

        //begin trans
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        $num = 0;//rand(0,36);
        
        if($ulog > 0 && $ulog < $Korisnik->Tokeni){

            $Korisnik->Tokeni -= $ulog;

            //kreita se rulet objekat
            $tm = new RuletModel();
                $tm->save([
                'IdKorisnik' => $Korisnik->IdKorisnik,
                'IzvucenBroj' => $num,
                'Vreme' => date("Y-m-d h:i:sa") //2021-05-27 13:35:35
            ]);

            $idRulet = $tm->getInsertId();
            //kreira se rulet tiket objekat
            $trm = new TiketRuletModel();
            $trm->save([
                'IdRulet' => $idRulet,
                'IdKorisnik' => $Korisnik->IdKorisnik,
                'Ulog' => $ulog,
                'Dobitak' => 0
            ]);
            

            $dobitak = 0;

            foreach($rulet as $tip => $ulozeno_str) {
                $ulozeno = intval($ulozeno_str);
                if($ulozeno > 0){

                    $coef = $handlers[$tip]($num);
                    $dobitak += $ulozeno * $coef;
                    //kreiranje stavke rulet
                    $srm = new StavkaRuletModel();
                    $prosla = $coef != 0;
                    $srm->save([
                        'IdRulet' => $idRulet, 
                        'IdKorisnik' => $Korisnik->IdKorisnik, 
                        'Tip' => $tip, 
                        'Prosla' => $prosla,
                        'Ulog' => $ulozeno
                    ]);
                }
            }

            //azuriranje rulet tiket dobitka
            $trm->set("Dobitak", $dobitak)
                            ->where('IdRulet', $idRulet)
                            ->where('IdKorisnik', $Korisnik->IdKorisnik)
                            ->update();

            
            
            $Korisnik->Tokeni += $dobitak;
            $km->set("Tokeni",$Korisnik->Tokeni)
                            ->where('KorisnickoIme', $Korisnik->KorisnickoIme)
                            ->update();

            
            
        }
        //end trans
        echo $num . "," . $Korisnik->Tokeni;
        
       
    }
    
    public function spin(){
        
        $coef = 0;
        
        $tokeni = intval($this->request->getVar('Tokeni'));
        $num1 = rand(0,7);
        $num2 = rand(0,7);
        $num3 = rand(0,7);
        //begin trans
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        if($tokeni != 0 && $Korisnik->Tokeni > $tokeni){
            $Korisnik->Tokeni -= $tokeni;
            $dobitak = 0;
            
            if($num1==6 && $num2==6 && $num3==6)
                $coef = 500;
            else if($num1==4 && $num2==4 && $num3==4)
                $coef = 250;
            else if($num1==1 && $num2==1 && $num3==1)
                $coef = 150;
            else if($num1==7 && $num2==7 && $num3==7)
                $coef = 100;
            else if($num1==4 && $num2==7 && $num3==1)
                $coef = 80;
            else if($num1==2 && $num2==2 && $num3==2)
                $coef = 80;
            else if($num1==2 && $num2==2)
                $coef = 50;
            else if($num1==3 && $num2==3 && $num3==3)
                $coef = 50;
            else if($num1==3 && $num2==3)
                $coef = 40;
            else if($num1==0 && $num2==0 && $num3==0)
                $coef = 30;
            else if($num1==0 && $num2==0)
                $coef = 15;
            else if($num1==5 && $num2==5 && $num3==5)
                $coef = 10;
            else if($num1==5 && $num2==5)
                $coef = 5;
            else if($num1==5)
                $coef = 2;
            
            
            
            $Korisnik->Tokeni += $tokeni * $coef;
            $dobitak = $tokeni * $coef;
            
            $km->set("Tokeni",$Korisnik->Tokeni)
                        ->where('KorisnickoIme', $Korisnik->KorisnickoIme)
                        ->update();
            $tsm = new TiketSlotModel();
            $tsm->save([
            'IdKorisnik' => $Korisnik->IdKorisnik,
            'Ulog' => $tokeni,
            'Dobitak' => $dobitak,
            'Rezultat' => $num1 . "," . $num2 . "," . $num3
            ]);
        }
        //end trans
        echo $num1 . "," . $num2 . "," . $num3 . "," . $Korisnik->Tokeni;
        
        
    }
    
    public function slot(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        $this->prikaz('slotKorisnik',['Tokeni'=>$Korisnik->Tokeni]);
    }
    
    public function lucky6(){
        $this->prikaz('lucky6Korisnik',[]);
    }
    
    public function lucky6_drawing(){
        $niz = $this->request->getVar('niz');
        
        $korisnik_brojevi = [];
        for($i = 0; $i < 6; $i++)
            $korisnik_brojevi[i] = intval($niz[i]);
        
        $ulozeni_tokeni = intval($niz[6]);
        
        $brojevi = [];
        
        for($i = 1; $i < 48; $i++){
            $brojevi = $i;
        }
        shuffle($brojevi);
        
        $izvuceni_brojevi = "";
        $i = 1;
        for(;$i < 48; $i++){
            $num = array_shift($brojevi);
            for($j = 0; $j < count($korisnik_brojevi); $j++){
                if($num == $korisnik_brojevi[$i]){
                    unset($korisnik_brojevi[$i]);
                    $korisnik_brojevi = array_values($korisnik_brojevi);
                }
                
            }
            $izvuceni_brojevi .= $num .",";
            if(count($korisnik_brojevi) == 0)
                break;
        }
        $coef = 0;
        if(count($korisnik_brojevi) == 0){
            $coef = kvote[$i];
        }
        
        $dobitak = $coef * $ulozeni_tokeni;
    }
    
    public function sport(){
        $this->prikaz('sportKorisnik',[]);
    }
    
    public function profil(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        //var_dump($korIme);
        
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik]);
    }
    
    public function promenaLozinke(){
        $errors=[];
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $stara=$this->request->getVar('stara');
        $nova=$this->request->getVar('nova');
        $potvrda=$this->request->getVar('potvrda');
        
        if(!$this->validate(['stara'=>'required', 
                                'nova'=>'required',
                                'potvrda'=>'required'])){
            if(!empty($this->validator->getErrors()['stara']))
                $errors['stara'] = 'Unesite staru lozinku';
            if(!empty($this->validator->getErrors()['nova']))
                $errors['nova'] = 'Unesite novu lozinku';
            if(!empty($this->validator->getErrors()['potvrda']))
                $errors['potvrda'] = 'Potvrdite lozinku';        
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }
        $greska=0;
        if($nova!=$potvrda){
            $errors['poklapanje'] = 'Lozinke se ne poklapaju';
            $greska++;
        }
        if($stara!=$korisnik->Lozinka){
            $errors['losaLozinka'] = 'Stara lozinka je netacna';
            $greska++;
        }
        if($greska)
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        var_dump($stara);
            var_dump($nova);
            var_dump($potvrda);
        $lozinka['Lozinka']=$nova;
        $km->update($korisnik->IdKorisnik, $lozinka);
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik]);
    }
    
    public function kupovinaTokena(){$errors=[];
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $tokeni=$this->request->getVar('tokeniKupovina');
                
        if(!$this->validate(['tokeniKupovina'=>'required'])){
            if(!empty($this->validator->getErrors()['tokeni']))
                $errors['tokeni'] = 'Unesite kolicinu tokena';
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }        
        if($tokeni<1){
            $errors['kolicina'] = 'Kolicina tokena mora biti veca od 0';
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }
        $noviTokeni['Tokeni']=$korisnik->Tokeni+$tokeni;
        $korisnik->Tokeni+=$tokeni;
        $km->update($korisnik->IdKorisnik, $noviTokeni);
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik]);
    }
    
    public function prodajaTokena(){$errors=[];
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $tokeni=$this->request->getVar('tokeniProdaja');
                
        if(!$this->validate(['tokeniProdaja'=>'required'])){
            if(!empty($this->validator->getErrors()['tokeni']))
                $errors['tokeni'] = 'Unesite kolicinu tokena';
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }
        $greska=0;
        if($tokeni<1){
            $errors['kolicina'] = 'Kolicina tokena mora biti veca od 0';
           $greska++;
        }
        if($tokeni>$korisnik->Tokeni){
            $errors['minus'] = 'Kolicina tokena mora biti manja od trennutnog stanja tokena';
           $greska++;
        }
        if($greska)
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        $noviTokeni['Tokeni']=$korisnik->Tokeni-$tokeni;
        $korisnik->Tokeni-=$tokeni;
        $km->update($korisnik->IdKorisnik, $noviTokeni);
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik]);
    }
}
