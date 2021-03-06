<?php

/*
    Autori:
  *     Marko Gloginja,
  *     Stefan Lukovic,
  *     Marko Lisicic,
  *     Nikola Marinkovic
 */

namespace App\Controllers;
use \App\Models\KorisnikModel;
use \App\Models\TiketSlotModel;
use \App\Models\RuletModel;
use \App\Models\TiketRuletModel;
use \App\Models\StavkaRuletModel;
use App\Models\TimModel;
use App\Models\UtakmicaModel;
use \App\Models\Lucky6Model;
use \App\Models\TiketLucky6Model;
use \App\Models\StavkaTiketModel;
use App\Models\TiketKladjenjeModel;


/**
* Korisnik.php – klasa za funkcionalnosti korisnika
*
* @version 1.0
*/
class Korisnik extends BaseController{
    /*
        * Funkcija koja sluzi za prikaz stranica Korisnika
        *
        * @param $page, $data
        * 
        * $page - ime stranice na koju idemo, $data - podaci koji se prosledjuju stranici
        * 
        * @return void
        *
        
    */
    
    protected function prikaz($page, $data) {
        $data['controller']='Korisnik';
        echo view('sablon/header_korisnik');
        //echo view ("stranice/meniKorisnik");
        echo view ("stranice/$page", $data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetnaKorisnik',[]);
    }
    public function pocetna(){
        $this->prikaz('pocetnaKorisnik',[]);
    }
    
    /*
        * Funkcija koja sluzi za odjavljivanje Administratora
        * 
        * @return redirektuje na pocetnu stranicu Administratora
        *
        * Autori:
  *     Marko Gloginja,
  *     Stefan Lukovic
        
    */
    
    public function odjava(){  
        $this->session->destroy();
        return redirect()->to(base_url('/'));

    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice ruleta Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function rulet(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $this->prikaz('ruletKorisnik',['tokeni' => $Korisnik->Tokeni]);
    }
    
    /*
        * Funkcija koja sluzi za pokretanje igre ruleta iz uloge Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function rulet_spin(){
        $handlers = [
            '0' => function($num){
                return  $num == 0 ? 36 : 0;
            },
            '1' => function($num){
                return  $num == 1 ? 36 : 0;
            },
            '2' => function($num){
                return  $num == 2 ? 36 : 0;
            },
            '3' => function($num){
                return  $num == 3 ? 36 : 0;
            },
            '4' => function($num){
                return  $num == 4 ? 36 : 0;
            },
            '5' => function($num){
                return  $num == 5 ? 36 : 0;
            },
            '6' => function($num){
                return  $num == 6 ? 36 : 0;
            },
            '7' => function($num){
                return  $num == 7 ? 36 : 0;
            },
            '8' => function($num){
                return  $num == 8 ? 36 : 0;
            },
            '9' => function($num){
                return  $num == 9 ? 36 : 0;
            },
            '10' => function($num){
                return  $num == 10 ? 36 : 0;
            },
            '11' => function($num){
                return  $num == 11 ? 36 : 0;
            },
            '12' => function($num){
                return  $num == 12 ? 36 : 0;
            },
            '13' => function($num){
                return  $num == 13 ? 36 : 0;
            },
            '14' => function($num){
                return  $num == 14 ? 36 : 0;
            },
            '15' => function($num){
                return  $num == 15 ? 36 : 0;
            },
            '16' => function($num){
                return  $num == 16 ? 36 : 0;
            },
            '17' => function($num){
                return  $num == 17 ? 36 : 0;
            },
            '18' => function($num){
                return  $num == 18 ? 36 : 0;
            },
            '19' => function($num){
                return  $num == 19 ? 36 : 0;
            },
            '20' => function($num){
                return  $num == 20 ? 36 : 0;
            },
            '21' => function($num){
                return  $num == 21 ? 36 : 0;
            },
            '22' => function($num){
                return  $num == 22 ? 36 : 0;
            },
            '23' => function($num){
                return  $num == 23 ? 36 : 0;
            },
            '24' => function($num){
                return  $num == 24 ? 36 : 0;
            },
            '25' => function($num){
                return  $num == 25 ? 36 : 0;
            },
            '26' => function($num){
                return  $num == 26 ? 36 : 0;
            },
            '27' => function($num){
                return  $num == 27 ? 36 : 0;
            },
            '28' => function($num){
                return  $num == 28 ? 36 : 0;
            },
            '29' => function($num){
                return  $num == 29 ? 36 : 0;
            },
            '30' => function($num){
                return  $num == 30 ? 36 : 0;
            },
            '31' => function($num){
                return  $num == 31 ? 36 : 0;
            },
            '32' => function($num){
                return  $num == 32 ? 36 : 0;
            },
            '33' => function($num){
                return  $num == 33 ? 36 : 0;
            },
            '34' => function($num){
                return  $num == 34 ? 36 : 0;
            },
            '35' => function($num){
                return  $num == 35 ? 36 : 0;
            },
            '36' => function($num){
                return  $num == 36 ? 36 : 0;
            },
            '2 to 1 a' => function($num){
                return in_array($num, [3 , 6 , 9 , 12,
                                       15, 18, 21, 24,
                                       27, 30, 33, 36]) ? 3 : 0;
            },
            '2 to 1 b' => function($num){
                return in_array($num, [2 , 5 , 8 , 11,
                                       14, 17, 20, 23,
                                       26, 29, 32, 35]) ? 3 : 0;
            },
            '2 to 1 c' => function($num){
                return in_array($num, [1 , 4 , 7 , 10,
                                       13, 16, 19, 22,
                                       25, 28, 31, 34]) ? 3 : 0;
            },
            '1st12' => function($num){
                return  (1 <= $num && $num <=12) ? 3 : 0;
            },
            '2nd12' => function($num){
                return  (13 <= $num && $num <=24) ? 3 : 0;
            },
            '3rd12' => function($num){
                return  (25 <= $num && $num <=36) ? 3 : 0;
            },
            '1 to 18' => function($num){
                return  (1 <= $num && $num <=18) ? 2 : 0;
            },
            '19 to 36' => function($num){
                return  (19 <= $num && $num <=36) ? 2 : 0;
            },
            'Even' => function($num){
                return  ($num % 2 == 0 && $num!=0) ? 2 : 0;
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
        
        $num = rand(0,36);
        $dobitak = -1;
        
        if($ulog > 0 && $ulog <= $Korisnik->Tokeni){

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
        echo $num . "," . $Korisnik->Tokeni .','. $dobitak;
        
       
    }
   
    /*
        * Funkcija koja sluzi za pokretanje slot masine iz uloge Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
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
        $dobitak = 0;
        if($tokeni != 0 && $Korisnik->Tokeni >= $tokeni){
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
        echo $num1 . "," . $num2 . "," . $num3 . "," . $Korisnik->Tokeni.",".$dobitak;
        
        
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice slota Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function slot(){
        $km = new KorisnikModel();
        $korIme =$this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        $this->prikaz('slotKorisnik',['Tokeni'=>$Korisnik->Tokeni]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice lucky6 Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function lucky6(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $this->prikaz('lucky6Korisnik',['Tokeni'=>$Korisnik->Tokeni]);
    }
    
    /*
        * Funkcija koja sluzi za pokretanje igre lucky6 Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function lucky6_drawing(){
        $kvote = [
            0,
            0,
            0,
            0,
            0,
            25000,
            15000,
            7500,
            3000,
            1250,
            700,
            350,
            250,
            175,
            125,
            100,
            90,
            80,
            70,
            60,
            50,
            35,
            25,
            20,
            15,
            12,
            10,
            8,
            7,
            6,
            5,
            4,
            3,
            2,
            1,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            0
        ];
        
        $niz = explode(",", $this->request->getVar('niz'));
        $kombinacija = [];
        $korisnik_brojevi = [];
        for($i = 0; $i < 6; $i++)
            $kombinacija[$i] = 
                $korisnik_brojevi[$i] = intval($niz[$i]);
        
        $ulozeni_tokeni = intval($niz[6]);
        
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        if($ulozeni_tokeni != 0 && $Korisnik->Tokeni >= $ulozeni_tokeni){
            $Korisnik->Tokeni -= $ulozeni_tokeni;
            $dobitak = 0;
            $brojevi = [];

            for($i = 1; $i < 48; $i++){
                $brojevi[] = $i;
            }
            shuffle($brojevi);

            $izvuceni_brojevi = "";
            $izvucnen = 0;
            for($i = 1 ; $i <= 35; $i++){
                $num = array_shift($brojevi);
                for($j = 0; $j < count($korisnik_brojevi); $j++){
                    if($num == $korisnik_brojevi[$j]){
                        unset($korisnik_brojevi[$j]);
                        $korisnik_brojevi = array_values($korisnik_brojevi);
                        break;
                    }
                }
                $izvuceni_brojevi .= $num .",";
                if(count($korisnik_brojevi) != 0)
                    $izvucnen++;
            }

            $coef = $kvote[$izvucnen];
            $dobitak = $coef * $ulozeni_tokeni;
            
            $izvuceni_brojevi .= $dobitak .",";
            
            $Korisnik->Tokeni += $dobitak;
            $km->set("Tokeni",$Korisnik->Tokeni)
                        ->where('KorisnickoIme', $Korisnik->KorisnickoIme)
                        ->update();
            
            $l6m = new Lucky6Model();
            
            $l6m->save([
            'IzvuceniBrojevi' => substr($izvuceni_brojevi, 0, strlen($izvuceni_brojevi) - 1),
            'Vreme' => date("Y-m-d h:i:sa")
            ]);
            $idl6 = $l6m->getInsertID();
            
            $tl6m = new TiketLucky6Model();
            $tl6m->save([
            'IdKorisnik' => $Korisnik->IdKorisnik, 
            'IdLucky6' => $idl6, 
            'Ulog' => $ulozeni_tokeni, 
            'Dobitak' => $dobitak, 
            'Kombinacija' => implode(",", $kombinacija)
            ]);
            
  
        }
        //end trans
        if(empty($izvuceni_brojevi))
            $izvuceni_brojevi = '-1,';
        echo $izvuceni_brojevi . $Korisnik->Tokeni . ',';
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice sportskog kladjenja Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function sport(){
        date_default_timezone_set('Europe/Belgrade');
        $vremeTrenutno = strtotime(date("Y-m-d\TH:i"));
        
        $tm = new TimModel();        
        $timovi = $tm->findAll();
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) > ', $vremeTrenutno - 60*90)->findAll();
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                ->where('KorisnickoIme', $korIme)
                ->first();
        $this->prikaz('sportKorisnik',['timovi'=>$timovi, 'utakmice'=>$utakmice,'tokeni'=>$korisnik->Tokeni]);
    }
    
    /*
        * Funkcija koja sluzi za sastavljanje tiketa na stranici sportskog kladjenja Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic,
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function sportSubmit(){
        date_default_timezone_set('Europe/Belgrade');
        $vremeTrenutno = strtotime(date("Y-m-d\TH:i"));
        
        $tm = new TimModel();   
        
        $tm->db->transBegin();

        $timovi = $tm->findAll();
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) > ', $vremeTrenutno - 60*90)->findAll();
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        if(!$this->validate(['uplata'=>'required', ])){
        if(!empty($this->validator->getErrors()['uplata']))
            $errors['uplata'] = 'Unesite iznos za kladjenje';       
            return $this->prikaz('sportKorisnik',['errors'=>$errors, 'timovi'=>$timovi, 'utakmice'=>$utakmice,'tokeni'=>$korisnik->Tokeni]);
        }
        
        // pravi kod za logiku pocinje ovde
        
        $uplata = $this->request->getVar('uplata');
        $uplata = intval($uplata);
        
        if($uplata > $korisnik->Tokeni){
            $tm->db->transRollback();
            $errors['uplata'] = "Nemate dovoljan broj tokena";
            return $this->prikaz('sportKorisnik',['errors'=>$errors, 'timovi'=>$timovi, 'utakmice'=>$utakmice,'tokeni'=>$korisnik->Tokeni]);
        }
        
        
        if($uplata < 0){
            $errors['uplata'] = 'Unesite iznos za kladjenje veci od 0';
            return $this->prikaz('sportKorisnik',['errors'=>$errors, 'timovi'=>$timovi, 'utakmice'=>$utakmice,'tokeni'=>$korisnik->Tokeni]);
        }
        
        $brojUtakmica = $this->request->getVar('numOfGames');
        $nizUtakmica = explode(".", $this->request->getVar('nizUtakmica'));
        
        $ukupna_kvota = 1;
        
        
        $tkm = new TiketKladjenjeModel();
        $tkm->save(['IdKor'=> $korisnik->IdKorisnik, 
                   'Ulog' => $uplata, 
                   'Dobitak' =>0, 
                    'Status' => 0
            ]);
        $idTiketa = $tkm->getInsertID();
        $flag_izabrana_bar_jedna_utakmica = false;
        for($i = 0; $i<$brojUtakmica;$i++){
            $checkBox = $this->request->getVar('checkBoxRed'.$nizUtakmica[$i]);
            $radioButton = $this->request->getVar('radioRed'.$nizUtakmica[$i]);
            if($checkBox!= null && $checkBox == "on" && $radioButton!=null){
                $stm = new StavkaTiketModel();
                $ishod = $radioButton;
                
                //proveravamo dal se tekma i dalje igra
                
                $utakmica = $um->where('Rezultat',0)->where('IdUtakmica',$nizUtakmica[$i])->first();
                if($utakmica == null){
                    $tm->db->transRollback();
                    return;
                }
                
                $flag_izabrana_bar_jedna_utakmica = true;
                
                $stm->save([
                    'IdTiketKladjenje'=>$idTiketa,
                    'IdUtakmica'=>$nizUtakmica[$i], 
                    'Iznos'=>0, 
                    'KonacanIshod'=>$ishod, 
                    'Status'=>0
                ]);
                
                $imeKvote = "Kvota".$radioButton;
                $ukupna_kvota *= $utakmica->$imeKvote;
                
            }
        }
        
        if($flag_izabrana_bar_jedna_utakmica == false){
            $tm->db->transRollback();
            $errors['izbranaBarJednaUtakmica'] = "Nijedna utakmica nije izabrana";
            return $this->prikaz('sportKorisnik',['errors'=>$errors, 'timovi'=>$timovi, 'utakmice'=>$utakmice,'tokeni'=>$korisnik->Tokeni,]);
        }
        
        
        $tkm->set("Dobitak",$ukupna_kvota)
                        ->where('IdTiketKladjenje', $idTiketa)
                        ->update();
        
        $korisnik->Tokeni -= $uplata;
        $km->set("Tokeni",$korisnik->Tokeni)
                        ->where('KorisnickoIme', $korisnik->KorisnickoIme)
                        ->update();
        
         $tm->db->transCommit();
        return $this->prikaz('sportKorisnik',['timovi'=>$timovi, 'utakmice'=>$utakmice,'tokeni'=>$korisnik->Tokeni,'uspesno'=>"Uspesno ste uplatili tiket!"]);
        
        
    }
    
    /*
        * Funkcija koja sluzi za prikaz profila Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function profil(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        //var_dump($korIme);
  
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz istorije odigranih igara korsnika na stranici  Korisnika
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function istorijaSubmit(){
     $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        
        
        
        
        
//        $rulet[100]['ishod']
//        $rulet['ishod'] = "";
//        $rulet['stavke'] = "";
//        $rulet['ulozeno'] = "";
//        $rulet['osvojeno'] = "";
        
        
       
        
        
        $rulet = $this->request->getVar("Rulet");
        $ruletNiz = [];
        $brojac = 0;
        if($rulet != null){
            $trm = new TiketRuletModel();
            $tiketiRuleta = $trm->where("IdKorisnik",$korisnik->IdKorisnik)->findAll();
            foreach($tiketiRuleta as $tiket){
                $idRul = $tiket->IdRulet;
                $ruletNiz[$brojac]['ulozeno'] = $tiket->Ulog;
                $ruletNiz[$brojac]['osvojeno'] = $tiket->Dobitak;
                
                $rm = new RuletModel();
                $ruletIgra = $rm->where("IdRulet",$tiket->IdRulet)->first();
                $ruletNiz[$brojac]['ishod'] = $ruletIgra->IzvucenBroj;
                
                $nizOpklada = [];
                
                $srm = new StavkaRuletModel();
                $stavkeTiketa = $srm->where("IdRulet",$tiket->IdRulet)
                        ->where("IdKorisnik",$korisnik->IdKorisnik)
                        ->findAll();
                foreach($stavkeTiketa as $stavka){
                   $ulog = $stavka->Ulog;
                   $tip = $stavka->Tip;
                   
                   $nizOpklada[] = "".$tip.": ".$ulog;
                }
                $ruletNiz[$brojac]['opklada'] = $nizOpklada;
                
                $brojac++;
            }
        }
        
        $slot = $this->request->getVar("Slot");
        $brojac = 0;
        $slotNiz = [];
        if($slot != null){
            $nizVockica = ["Pomomrandza","2 Bar","Zvono","Sljiva","3 Bar","Tresnja","7","1 Bar"];
            
            $tsm = new TiketSlotModel();
            $tiketiSlota = $tsm->where("IdKorisnik",$korisnik->IdKorisnik)->findAll();
            foreach($tiketiSlota as $tiket){
                $slotNiz[$brojac]['ulozeno'] = $tiket->Ulog;
                $slotNiz[$brojac]['osvojeno'] = $tiket->Dobitak;

                $brojevi = explode(",", $tiket->Rezultat);
                $slotNiz[$brojac]['ishod'] = $nizVockica[intval($brojevi[0])];
                $slotNiz[$brojac]['ishod'] .= ", ".$nizVockica[intval($brojevi[1])];
                $slotNiz[$brojac]['ishod'] .= ", ".$nizVockica[intval($brojevi[2])];
                $slotNiz[$brojac]['opklada'] = "---";
                
                $brojac++;
            }
        }
        
        $lucky = $this->request->getVar("Lucky_6");
        $brojac = 0;
        $luckyNiz = [];
        if($lucky != null){
            
            $tlsm = new TiketLucky6Model();
            $tiketiLucky = $tlsm->where("IdKorisnik",$korisnik->IdKorisnik)->findAll();
            foreach($tiketiLucky as $tiket){
                $luckyNiz[$brojac]['ulozeno'] = $tiket->Ulog;
                $luckyNiz[$brojac]['osvojeno'] = $tiket->Dobitak;
                $luckyNiz[$brojac]['opklada'] = $tiket->Kombinacija;
                
                $lsm = new Lucky6Model();
                $luckyIgra = $lsm->where("IdLucky6",$tiket->IdLucky6)->first();
                $luckyNiz[$brojac]['ishod'] = $luckyIgra->IzvuceniBrojevi;

                $brojac++;
            }
        }
        
        $sport = $this->request->getVar("Sport");
        $brojac = 0;
        $sportNiz = [];
        if($sport != null){
            
            $tkm = new TiketKladjenjeModel();
            $tiketiKladjenja = $tkm->where("IdKor",$korisnik->IdKorisnik)->findAll();
            foreach($tiketiKladjenja as $tiket){
                $idTiket = $tiket->IdTiketKladjenje;
                $sportNiz[$brojac]['ulozeno'] = $tiket->Ulog;
                if($tiket->Status == 0){
                    $sportNiz[$brojac]['osvojeno'] = "-";
                }
                else
                    $sportNiz[$brojac]['osvojeno'] = $tiket->Dobitak;
                
                $nizOpklada = [];
                $nizIshoda = [];
                
                $stm = new StavkaTiketModel();
                $stavkeTiketa = $stm->where("IdTiketKladjenje",$tiket->IdTiketKladjenje)
                        ->findAll();
                foreach($stavkeTiketa as $stavka){
                   $um = new UtakmicaModel();
                   $utakmica = $um->where("IdUtakmica",$stavka->IdUtakmica)->first();
                   
                   $domacinID = $utakmica->IdDomacin;
                   $gostID = $utakmica->IdGost;
                   
                   $tm = new TimModel();
                   $domacin = $tm->where("IdTim",$domacinID)->first();
                   $gost = $tm->where("IdTim",$gostID)->first();
                   
                   $nizOpklada[] = $domacin->Ime." - ".$gost->Ime.": ".$stavka->KonacanIshod;
                   $nizIshoda[] = $domacin->Ime." - ".$gost->Ime.": ".$utakmica->Rezultat;
                   
                   
                }
                $sportNiz[$brojac]['opklada'] = $nizOpklada;
                $sportNiz[$brojac]['ishod'] = $nizIshoda;
                
                $brojac++;
            }
        }
        $errors = [];
        if($this->request->getVar("prviPut")==null && 
                count($ruletNiz) == 0 &&
                count($slotNiz) == 0 &&
                count($luckyNiz) == 0 &&
                count($sportNiz) == 0)
            $errors['nepostojeci'] = "Ne postoje podaci za odabrane filtere";
        
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik,'ruletNiz'=>$ruletNiz,'slotNiz'=>$slotNiz,'luckyNiz'=>$luckyNiz,'sportNiz'=>$sportNiz,'filter'=>$errors]);
    }
    
    /*
        * Funkcija koja vrsi promenu lozinke Korisnika i azurira je u bazi podataka
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
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
                                'nova'=>'required|min_length[8]',
                                'potvrda'=>'required|matches[nova]'])){
            if(!empty($this->validator->getErrors()['stara']))
                $errors['stara'] = 'Unesite staru lozinku.';
            if(!empty($this->validator->getErrors()['nova']))
                $errors['nova'] = 'Unesite novu lozinku duzine barem 8 karaktera.';
            if(!empty($this->validator->getErrors()['potvrda']))
                $errors['potvrda'] = 'Potvrdjena lozinka se ne poklapa.';        
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }
        $greska=0;
        
        
        if(!password_verify($stara, $korisnik->Lozinka)){
            $errors['losaLozinka'] = 'Stara lozinka je netacna';
            $greska++;
        }
        if($nova!=$potvrda){
            $errors['poklapanje'] = 'Lozinke se ne poklapaju';
            $greska++;
        }
        else if($stara==$nova){
            $errors['ista'] = 'Nova lozinka je ista kao i stara';
            $greska++;
        }
        if($greska)
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        $lozinka['Lozinka']=password_hash($nova, PASSWORD_DEFAULT);;
        $km->update($korisnik->IdKorisnik, $lozinka);
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik,'uspesno'=>1]);
    }
    
    /*
        * Funkcija koja vrsi kupovinu tokena na stranici Korisnika i azurira njegovo stanje u bazi
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function kupovinaTokena(){
        $errors=[];
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
                
        if(!$this->validate(['tokeniKupovina'=>'required'])){
            if(!empty($this->validator->getErrors()['tokeniKupovina']))
                $errors['tokeniK'] = 'Unesite kolicinu tokena';
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        } 
        $tokeni=$this->request->getVar('tokeniKupovina');
        if($tokeni<1){
            $errors['kolicinaK'] = 'Kolicina tokena mora biti veca od 0';
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }
        $noviTokeni['Tokeni']=$korisnik->Tokeni+$tokeni;
        $korisnik->Tokeni+=$tokeni;
        $km->update($korisnik->IdKorisnik, $noviTokeni);
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik,"uplata"=>1]);
    }
    
    /*
        * Funkcija koja vrsi prodaju tokena na stranici Korisnika i azurira njegovo stanje u bazi
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function prodajaTokena(){
        $errors=[];
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $tokeni=$this->request->getVar('tokeniProdaja');
                
        if(!$this->validate(['tokeniProdaja'=>'required'])){
            if(!empty($this->validator->getErrors()['tokeniProdaja']))
                $errors['tokeniP'] = 'Unesite kolicinu tokena';
            return $this->prikaz('profilKorisnik',['errors'=>$errors, 'korisnik'=>$korisnik]);
        }
        $greska=0;
        if($tokeni<1){
            $errors['kolicinaP'] = 'Kolicina tokena mora biti veca od 0';
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
        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik,"isplata"=>1]);
    }
    
    
    
}
