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
use \App\Models\ZaposleniModel;
use \App\Models\TimModel;
use \App\Models\UtakmicaModel;
use \App\Models\StavkaTiketModel;
use App\Models\TiketKladjenjeModel;
use App\Models\TiketLucky6Model;
use App\Models\Lucky6Model;
use App\Models\TiketRuletModel;
use App\Models\RuletModel;
use App\Models\StavkaRuletModel;
use App\Models\TiketSlotModel;
/**
* Administrator.php – klasa za funkcionalnosti administratora
*
* @version 1.0
*/
class Administrator extends BaseController {
    
    /*
        * Funkcija koja sluzi za prikaz stranica Administratora
        *
        * @param $page, $data
        * 
        * $page - ime stranice na koju idemo, $data - podaci koji se prosledjuju stranici
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    protected function prikaz($page, $data) {
        $data['controller']='Administrator';
        echo view('sablon/header_administrator');
        //echo view ("stranice/meniAdministrator");
        echo view ("stranice/$page",$data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetnaAdministrator',[]);
    }
    
    public function pocetna(){
        $this->prikaz('pocetnaAdministrator',[]);
    }
    
    /*
        * Funkcija koja sluzi za odjavljivanje Administratora
        * 
        * @return redirektuje na pocetnu stranicu Administratora
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function odjava(){
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice ruleta Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function rulet(){
        $this->prikaz('ruletAdmin',[]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice slota Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function slot(){
        $this->prikaz('slotAdmin',[]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice lucky6 Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function lucky6(){
        $this->prikaz('lucky6Admin',[]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice sportskog kladjenja Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function sport(){
            $tm = new TimModel();        
            $timovi = $tm->findAll();
            $um = new UtakmicaModel();        
            $utakmice = $um->where('Rezultat',"0")->findAll();
        $this->prikaz('sportAdmin',['timovi'=>$timovi, 'utakmice'=>$utakmice]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz profila Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function profil(){
        $zm = new ZaposleniModel();
        $korIme = $this->session->get('administrator')->KorisnickoIme;
        $zaposleni = $zm
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $this->prikaz('profilAdmin',["zaposlen"=>$zaposleni]);
    }
    
    /*
        * Funkcija koja vrsi promenu lozinke Administratora i azurira je u bazi podataka
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function promenaLozinke(){
        $errors=[];
        $zm = new ZaposleniModel();
        $korIme = $this->session->get('administrator')->KorisnickoIme;
        $zaposlen = $zm
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
            return $this->prikaz('profilModerator',['errors'=>$errors, 'zaposlen'=>$zaposlen]);
        }
        $greska=0;
        
        if(!password_verify($stara, $zaposlen->Lozinka)){
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
            return $this->prikaz('profilAdmin',['errors'=>$errors, 'zaposlen'=>$zaposlen]);
        $lozinka['Lozinka']=password_hash($nova, PASSWORD_DEFAULT);
        $zm->update($zaposlen->IdZaposleni, $lozinka);
        $this->prikaz('profilAdmin',['zaposlen'=>$zaposlen,"uspesno"=>"Sifra uspesno promenjena!"]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz utakmica na stranici Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function utakmica(){
        $this->prikaz('utakmicaAdmin',[]);
    }
    
     /*
        * Funkcija koja sluzi za prikaz kvota na stranici Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function kvote(){            
        $this->prikaz('kvoteAdmin',[]);
    }
    
    /*
        * Funkcija koja sluzi za ispis uspesnog dodavanja tima na stranici Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic
        
    */
    
    public function tim(){
        $uspeh = $this->session->getFlashdata('uspesno');
        $this->prikaz('timAdmin',["uspeh"=>$uspeh]);
    }
    
    /*
        * Funkcija koja sluzi za dodavanje tima u bazu podataka iz uloge Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic
        
    */
    
    public function dodajTim(){
        if(!$this->validate(['tim_ime'=>'required'])){
            if(!empty($this->validator->getErrors()['tim_ime']))
                $errors['TimIme'] = 'Unesite ime tima';
            return $this->prikaz('timAdmin',['errors'=>$errors]);
        }
        $tm = new TimModel();     
        $tim = $tm
                ->where('Ime', $this->request->getVar('tim_ime'))
                ->first();
        if($tim != null){
            $errors['TimIme'] = 'Tim vec postoji';
            return $this->prikaz('timAdmin',['errors'=>$errors]);
        }
        $tm->save(['Ime' => $this->request->getVar('tim_ime')]);
        $this->session->setFlashdata('uspesno',"Tim uspesno postavljen!");
        return redirect()->to(base_url('Administrator/tim'));     
    }
    
    /*
        * Funkcija koja dodavanje utakmica u bazu podataka iz uloge Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function dodajUtakmicu(){
        $errors = [];
        if(!$this->validate(['kvota1'=>'required',
                            'kvotaX'=>'required',            
                            'kvota2'=>'required',
                            'vreme'=>'required'])){
            if(!empty($this->validator->getErrors()['kvota1']))
                $errors['Kvota1'] = 'Unesite kvotu za rezultat 1';
            if(!empty($this->validator->getErrors()['kvotaX']))
                $errors['KvotaX'] = 'Unesite kvotu za rezultat X';
            if(!empty($this->validator->getErrors()['kvota2']))
                $errors['Kvota2'] = 'Unesite kvotu za rezultat 2';
            if(!empty($this->validator->getErrors()['vreme']))
                $errors['Vreme'] = 'Izaberite vreme';
            
            return $this->prikaz('utakmicaAdmin',['errors'=>$errors]);
        }       
        date_default_timezone_set('Europe/Belgrade');
     
        $um = new UtakmicaModel();   
        $kvota1=$this->request->getVar('kvota1');
        $kvota2=$this->request->getVar('kvota2');
        $kvotaX=$this->request->getVar('kvotaX');
        $idDomacin=$this->request->getVar('domacin');
        $idGost=$this->request->getVar('gost');
        $vreme = $this->request->getVar('vreme');        
        $vremeTrenutno = date("Y-m-d\TH:i");
        
        if($idDomacin==$idGost)
             $errors['Teams='] = 'Timovi moraju biti razliciti';
        if($kvota1<1)
             $errors['Kvota1-'] = 'Kvota mora biti veca od 1';
        if($kvotaX<1)
             $errors['KvotaX-'] = 'Kvota mora biti veca od 1';
        if($kvota2<1)
             $errors['Kvota2-'] = 'Kvota mora biti veca od 1';
        if($vreme<$vremeTrenutno)
             $errors['Vreme'] = 'Vreme utakmice nevalidno!';
        if(!empty($errors))
            return $this->prikaz('utakmicaAdmin',['errors'=>$errors]);
        $um->save([ 'Rezultat' => "0",
                'Vreme'=> $this->request->getVar('vreme'),
                'IdDomacin' => $idDomacin,
                'IdGost' => $idGost,
                'KvotaX' => $kvotaX,
                'Kvota1' => $kvota1,
                'Kvota2' => $kvota2]);
        return $this->prikaz('utakmicaAdmin',["uspesno"=>"Uspesno ste dodali utakmicu!"]);
    }
    
    /*
        * Funkcija koja sluzi za ispis uspesnog dodavanja novog zaposlenog na stranici  Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function modadm(){
        $uspesno = $this->session->getFlashdata("uspesno");
        $this->prikaz('modadmAdmin',['uspesno'=>$uspesno]);
    }
    
     /*
        * Funkcija koja dodavanje novog zaposlenog (administratora ili moderatoora) iz uloge  Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function dodavanjeZaposlenog() {
        $errors = [];
        if(!$this->validate(['username_registration'=>'required', 
                                'password_registration'=>'required|min_length[8]',
                                'passconfirm_registration'=>'required|matches[password_registration]',
                                'name_registration'=>'required',
                                'surname_registration'=>'required',
                                'id_registration'=>'required|min_length[13]|max_length[13]',
                                'type'=>'required' ])){
            if(!empty($this->validator->getErrors()['username_registration']))
                $errors['KorisnickoIme'] = 'Unesite korisnicko ime';
            if(!empty($this->validator->getErrors()['password_registration']))
                $errors['Lozinka'] = 'Unesite lozinku od barem 8 karaktera';
            if(!empty($this->validator->getErrors()['passconfirm_registration']))
                $errors['PotvrdaLozinke'] = 'Lozinke se ne poklapaju';
            if(!empty($this->validator->getErrors()['name_registration']))
                $errors['Ime'] = 'Unesite ime';
            if(!empty($this->validator->getErrors()['surname_registration']))
                $errors['Prezime'] = 'Unesite prezime';
            if(!empty($this->validator->getErrors()['id_registration']))
                $errors['JMBG'] = 'Unesite JMBG duzine 13';
            if(!empty($this->validator->getErrors()['type']))
                $errors['Tip'] = 'Unesite tip';
            
            return $this->prikaz('modadmAdmin',['errors'=>$errors]);
        }
        
        //ddmmggg.......
        $JMBG = $this->request->getVar('id_registration');
        $day = intval(substr($JMBG, 0, 2));
        $month = intval(substr($JMBG, 2, 2));
        $year = substr($JMBG, 4, 3);
        if($year[0]=="9")
            $year = intval($year) + 1000;
        else
            $year = intval($year) + 2000;
        $date1 = mktime (0, 0, 0, $month, $day, $year) ;
        $date2 = strtotime(date("Y-m-d\TH:i")); 
        $diff = $date2 - $date1; 
        $years = floor($diff / (365*60*60*24));        
        if($years < 18){
            $errors['JMBG'] = 'Niste punoletni';
            return $this->prikaz('modadmAdmin',['errors'=>$errors]);
        }    
        
        $km = new KorisnikModel;
        
        $korisnik = $km
                ->where('KorisnickoIme', $this->request->getVar('username_registration'))
                ->first();
        if($korisnik != null){
            $errors['KorisnickoIme'] = 'Korisnicko ime postoji medju korisnicima';
            return $this->prikaz('modadmAdmin',['errors'=>$errors]);
        }
        
        
        $zm = new ZaposleniModel();
        
        $zaposleni = $zm
                ->where('KorisnickoIme', $this->request->getVar('username_registration'))
                ->first();
        if($zaposleni != null){
            $errors['KorisnickoIme'] = 'Korisnicko ime postoji medju zaposlenima';
            return $this->prikaz('modadmAdmin',['errors'=>$errors]);
        }
        
        //proveriti da ne postoji isti jmbg i da je stariji od 18 god
        
        $lozinka = $this->request->getVar('password_registration');
        $hashLozinka = password_hash($lozinka, PASSWORD_DEFAULT);
        
        $zm->save([ 'KorisnickoIme' => $this->request->getVar('username_registration'),
            'Lozinka'=> $hashLozinka,
            'Ime' => $this->request->getVar('name_registration'),
            'Prezime' => $this->request->getVar('surname_registration'),
            'JMBG' => $this->request->getVar('id_registration'),
            'Tip' => $this->request->getVar('type') == "Moderator" ? 0 : 1]);

        $this->session->setFlashdata("uspesno","Zaposleni uspesno dodat!");
        return redirect()->to(base_url('Administrator/modadm'));
    }
    
     /*
        * Funkcija koja sluzi za prikaz korsnika na stranici  Administratora
        * 
        * @return void
        *
        * Autori:
            Nikola Marinkovic
        
    */
    
    public function uvid(){
        $this->prikaz('uvidAdmin',[]);
    }
    
    /*
        * Funkcija koja vrsi filtriranje i pretragu korsnika na stranici Administratora
        * 
        * @return void
        *
        * Autori:
            Nikola Marinkovic
        
    */
    
    public function uvidSubmit(){
        $sviKorisnici = false; //ako je prazno polje, vrati sve korisnike/moderatore/administrator, u zavisnosti od izabranog radio buttona
        $errors = [];
        if(!$this->validate(['username_uvid'=>'required','tipKorisnika'=>'required'])){
            if(!empty($this->validator->getErrors()['tipKorisnika'])){
                $errors['izabir'] = "Izaberite ulogu koju pretrazujete";
                return $this->prikaz('uvidAdmin',['errors'=>$errors]);
            }
            if(!empty($this->validator->getErrors()['username_uvid'])){
                $sviKorisnici = true;
            }

        }
        $uloga = $this->request->getVar('tipKorisnika');
        $sort = $this->request->getVar('sortiranje');
        $username = $this->request->getVar('username_uvid');
        $sortiranje = $this->request->getVar('sortiranje');
        $order = $sortiranje == "navise" ? 'ASC': 'DESC';
        
        if($uloga == "korisnik"){
                $km = new KorisnikModel();
                if($sviKorisnici == false)
                    $korisnici = $km->like('KorisnickoIme', "%".$username."%")->orderBy('KorisnickoIme',$order)->findAll();
                else
                    $korisnici = $km->orderBy('KorisnickoIme',$order)->findAll();
                
                
                if($korisnici==null || count($korisnici) == 0){
                    $errors['noUser'] = "Ne postoji korisnik sa tim korisnickim imenom";
                    return $this->prikaz('uvidAdmin',['errors'=>$errors]);
                }
                return $this->prikaz('uvidAdmin',['users'=>$korisnici,'uloga'=>$uloga]);
        }
        else if($uloga == "moderator"){
            $zm = new ZaposleniModel();
                if($sviKorisnici == false)
                    $korisnici = $zm->like('KorisnickoIme', "%".$username."%")->where("Tip",0)->orderBy('KorisnickoIme',$order)->findAll();
                else
                    $korisnici = $zm->where("Tip",0)->orderBy('KorisnickoIme',$order)->findAll();;
                
                if($korisnici==null || count($korisnici) == 0){
                    $errors['noUser'] = "Ne postoji ".$uloga." sa tim korisnickim imenom";
                    return $this->prikaz('uvidAdmin',['errors'=>$errors]);
                }
                return $this->prikaz('uvidAdmin',['users'=>$korisnici,'uloga'=>$uloga]);
        }
        
        else if($uloga == "administrator"){
           $zm = new ZaposleniModel();
                if($sviKorisnici == false)
                    $korisnici = $zm->like('KorisnickoIme', "%".$username."%")->where("Tip",1)->orderBy('KorisnickoIme',$order)->findAll();
                else
                    $korisnici = $zm->where("Tip",1)->orderBy('KorisnickoIme',$order)->findAll();
                
                if($korisnici==null || count($korisnici) == 0){
                    $errors['noUser'] = "Ne postoji ".$uloga." sa tim korisnickim imenom";
                    return $this->prikaz('uvidAdmin',['errors'=>$errors]);
                }
                return $this->prikaz('uvidAdmin',['users'=>$korisnici,'uloga'=>$uloga]);
        }
        
        
        
    }
    
    /*
        * Funkcija koja sluzi za prikaz istorije odigranih igara korsnika na stranici  Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function istorijaKorisnikSubmit(){
        
        $idKor = $this->request->getVar("idKor");
        $km = new KorisnikModel();
        $korisnik = $km->where("IdKorisnik",$idKor)->first();

        
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
        return $this->prikaz('uvidIstorijeKorisnika',['korisnik'=>$korisnik,'ruletNiz'=>$ruletNiz,'slotNiz'=>$slotNiz,'luckyNiz'=>$luckyNiz,'sportNiz'=>$sportNiz, 'errors'=>$errors]);
        
        
        //return $this->prikaz('uvidIstorijeKorisnika',['korisnik'=>$korisnik]);
    }
    
    /*
        * Funkcija koja azurira kvote u bazi podataka iz uloge Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function azurirajKvotu(){
        $ukupno = $this->request->getVar('ukupno');
        $um = new UtakmicaModel();
        $um->db->transBegin();
        
        for($i = 0; $i < $ukupno; $i++){
            $utakmica = $um->where('IdUtakmica',$this->request->getVar('utk'.($i + 1)))->first();
            $kvota1=$this->request->getVar('jedan'.($i + 1)); 
            $kvotaX=$this->request->getVar('iks'.($i + 1));
            $kvota2=$this->request->getVar('dva'.($i + 1));        
            $kvote=[];
            
            if(!$this->validate([
                    'jedan'.($i + 1)=>'required|numeric|greater_than[1.00]', 
                    'iks'.($i + 1)=>'required|numeric|greater_than[1.00]',
                    'dva'.($i + 1)=>'required|numeric|greater_than[1.00]'
                    ])){
            $um->db->transRollback();
            $errors['neispravna_kvota'] = "Unesite ispravne kvote";
            return $this->prikaz('kvoteAdmin',['errors'=>$errors]);
        }
        
            if(!empty($kvota1)&&($kvota1!=$utakmica->Kvota1)){
                $kvote['Kvota1']=$kvota1;                
            }
            if(!empty($kvota2)&&($kvota2!=$utakmica->Kvota2)){
                $kvote['Kvota2']=$kvota2;
            }
            if(!empty($kvotaX)&&($kvotaX!=$utakmica->KvotaX)){
                $kvote['KvotaX']=$kvotaX;
            }
            if(!empty($kvote)){
                $um->update($utakmica->IdUtakmica, $kvote);
            }
        }
        $um->db->transCommit();
        $this->prikaz('kvoteAdmin',["uspesno"=>"Kvote uspesno promenjene!"]);
    }
    
    /*
        * Funkcija koja sluzi unos rezultata utakmice iz uloge Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function dodajRezultat(){
        date_default_timezone_set('Europe/Belgrade');
        $vremeTrenutno = strtotime(date("Y-m-d\TH:i"));
        $tm = new TimModel();        
        $timovi = $tm->findAll();
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) < ', $vremeTrenutno - 60*90)->findAll();
        $this->prikaz('upisRezultataAdmin',['utakmice'=>$utakmice]);
    }
    
    /*
        * Funkcija koja sluzi unos rezultata utakmice iz uloge Administratora
        * 
        * @return void
        *
        * Autori:
            Marko Lisicic,
            Nikola Marinkovic
        
    */
    
    public function submitRezultat(){
        date_default_timezone_set('Europe/Belgrade');
        $vremeTrenutno = strtotime(date("Y-m-d\TH:i"));
        
        $tiketiZaAzuriranje = [];
        
        $tm = new TimModel();   
        
        $tkm = new TiketKladjenjeModel();
        $tkm->db->transBegin();
        
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) < ', $vremeTrenutno - 60*90)->findAll();
        
        // pravi kod za logiku pocinje ovde
        
        $brojUtakmica = $this->request->getVar('numOfGames');
        $nizUtakmica = explode(".", $this->request->getVar('nizUtakmica'));
        

        
        
        $flag_izabrana_bar_jedna_utakmica = false;
        for($i = 0; $i<$brojUtakmica;$i++){
            $checkBox = $this->request->getVar('checkBoxRed'.$nizUtakmica[$i]);
            $radioButton = $this->request->getVar('radioRed'.$nizUtakmica[$i]);
            if($checkBox!= null && $checkBox == "on" && $radioButton!=null){
                $stm = new StavkaTiketModel();
                $ishod = $radioButton;
                
                //proveravamo dal se tekma i dalje igra
                
                $utakmica = $um->where('Rezultat',"0")->where('IdUtakmica',$nizUtakmica[$i])->first();
//                if($utakmica == null){
//                    $tkm->db->transRollback();
//                    return;
//                }
                
                $flag_izabrana_bar_jedna_utakmica = true;
                
                $um->set("Rezultat",$ishod)
                        ->where('IdUtakmica', $nizUtakmica[$i])
                        ->update();
                $stavke = $stm->where("IdUtakmica",$nizUtakmica[$i])->findAll();
                foreach($stavke as $stavka){
                    $kladjenje = $stavka->KonacanIshod;
                    $status = 0;
                    if($kladjenje == $ishod){
                        $status = 2;
                    }
                    else
                        $status = 1;
                    
                    $stm->set("Status",$status)
                        ->where('IdUtakmica', $stavka->IdUtakmica)
                        ->where("IdTiketKladjenje",$stavka->IdTiketKladjenje)
                        ->update();
                    
                    $tiketiZaAzuriranje["id#".$stavka->IdTiketKladjenje] = 1;
                    
                    
                }
                
            }
        }
        
        if($flag_izabrana_bar_jedna_utakmica == false){
            $tkm->db->transRollback();
            $errors['izbranaBarJednaUtakmica'] = "Nijedna utakmica nije izabrana";
            $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) < ', $vremeTrenutno - 60*90)->findAll();
            return $this->prikaz('upisRezultataAdmin',['errors'=>$errors, 'utakmice'=>$utakmice]);
        }
        $dobitak = -1;
        foreach ($tiketiZaAzuriranje as $id => $value){
            $idTiketaCeo = explode("#",$id);
            $idTiketa = $idTiketaCeo[1];
            $tiket = $tkm->where("IdTiketKladjenje",$idTiketa)->first();
            if($tiket == null || $tiket->Status == 1){
                continue;
            }
            $stavkeNove = $stm->where("IdTiketKladjenje",$idTiketa)->findAll();
            if($stavkeNove == null){
                continue;
            }
            $nasao = [];
            $nasao["st0"] = false;
            $nasao["st1"] = false;
            $nasao["st2"] = false;
            foreach($stavkeNove as $stavka){
                $statusStavke = $stavka->Status;
                $nasao["st".$statusStavke] = true;
            }
            if($nasao["st1"] == true){
                $tkm->set("Status",1)
                        ->set("Dobitak",0)
                        ->where("IdTiketKladjenje",$idTiketa)
                        ->update();
                
            }
            else if($nasao["st0"] == false && $nasao["st2"] == true){
                $dobitak = $tiket->Ulog * $tiket->Dobitak;
                $tkm->set("Status",2)
                        ->set("Dobitak",$dobitak)
                        ->where("IdTiketKladjenje",$idTiketa)
                        ->update();
                
                $idKor = $tiket->IdKor;
                $km = new KorisnikModel();
                $korisnik = $km->where("IdKorisnik",$idKor)->first();
                if($korisnik == null){
                    continue;
                }
                
                $tokeni = $korisnik->Tokeni;
                $km->set("Tokeni",$tokeni + $dobitak)
                        ->where("IdKorisnik",$idKor)
                        ->update();
            }
            
            
        }
        
        //$utakmice = $um->where('Rezultat',"0")->findAll();
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) < ', $vremeTrenutno - 60*90)->findAll();
        $tkm->db->transCommit();
        return $this->prikaz('upisRezultataAdmin',['utakmice'=>$utakmice,"uspesno"=>"Rezultat uspesno upisan!"]);
        
    }   
}