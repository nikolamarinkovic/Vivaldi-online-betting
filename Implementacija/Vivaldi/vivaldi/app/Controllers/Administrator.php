<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
 * Description of Administrator
 *
 * @author Marko
 */
class Administrator extends BaseController {
    
    protected function prikaz($page, $data) {
        $data['controller']='Administrator';
        echo view('sablon/header_administrator');
        echo view ("stranice/meniAdministrator");
        echo view ("stranice/$page",$data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetnaAdministrator',[]);
    }
    
    public function pocetna(){
        $this->prikaz('pocetnaAdministrator',[]);
    }
    
    public function odjava(){
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
    
    public function rulet(){
        $this->prikaz('ruletAdmin',[]);
    }
    
    public function slot(){
        $this->prikaz('slotAdmin',[]);
    }
    
    public function lucky6(){
        $this->prikaz('lucky6Admin',[]);
    }
    
    public function sport(){
        $this->prikaz('sportAdmin',[]);
    }
    
    public function profil(){
        $this->prikaz('profilAdmin',[]);
    }
    
    public function utakmica(){
                $this->prikaz('utakmicaAdmin',[]);
    }
    
    public function kvote(){            
        $this->prikaz('kvoteAdmin',[]);
    }
    
    public function tim(){
        $this->prikaz('timAdmin',[]);
    }
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
        return redirect()->to(base_url('Administrator/tim'));     
    }
    
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
     
        $um = new UtakmicaModel();   
        $kvota1=$this->request->getVar('kvota1');
        $kvota2=$this->request->getVar('kvota2');
        $kvotaX=$this->request->getVar('kvotaX');
        $idDomacin=$this->request->getVar('domacin');
        $idGost=$this->request->getVar('gost');
        if($idDomacin==$idGost)
             $errors['Teams='] = 'Timovi moraju biti razliciti';
        if($kvota1<1)
             $errors['Kvota1-'] = 'Kvota mora biti veca od 1';
        if($kvotaX<1)
             $errors['KvotaX-'] = 'Kvota mora biti veca od 1';
        if($kvota2<1)
             $errors['Kvota2-'] = 'Kvota mora biti veca od 1';
        if(!empty($errors))
            return $this->prikaz('utakmicaAdmin',['errors'=>$errors]);
        $um->save([ 'Rezultat' => "0",
                'Vreme'=> $this->request->getVar('vreme'),
                'IdDomacin' => $idDomacin,
                'IdGost' => $idGost,
                'KvotaX' => $kvotaX,
                'Kvota1' => $kvota1,
                'Kvota2' => $kvota2]);
        return $this->prikaz('utakmicaAdmin',[]);
    }
    public function modadm(){
        $this->prikaz('modadmAdmin',[]);
    }
    
    public function dodavanjeZaposlenog() {
        $errors = [];
        if(!$this->validate(['username_registration'=>'required', 
                                'password_registration'=>'required',
                                'passconfirm_registration'=>'required|matches[password_registration]',
                                'name_registration'=>'required',
                                'surname_registration'=>'required',
                                'id_registration'=>'required|min_length[13]|max_length[13]',
                                'type'=>'required' ])){
            if(!empty($this->validator->getErrors()['username_registration']))
                $errors['KorisnickoIme'] = 'Unesite korisnicko ime';
            if(!empty($this->validator->getErrors()['password_registration']))
                $errors['Lozinka'] = 'Unesite lozinku';
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
        
        $zm->save([ 'KorisnickoIme' => $this->request->getVar('username_registration'),
            'Lozinka'=> $this->request->getVar('password_registration'),
            'Ime' => $this->request->getVar('name_registration'),
            'Prezime' => $this->request->getVar('surname_registration'),
            'JMBG' => $this->request->getVar('id_registration'),
            'Tip' => $this->request->getVar('type') == "Moderator" ? 0 : 1]);

        return redirect()->to(base_url('Administrator/modadmAdmin'));
    }
    
    
    public function uvid(){
        $this->prikaz('uvidAdmin',[]);
    }
    
    
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
        
        if($uloga == "korisnik"){
                $km = new KorisnikModel();
                if($sviKorisnici == false)
                    $korisnici = $km->like('KorisnickoIme', "%".$username."%")->findAll();
                else
                    $korisnici = $km->findAll();
                
                if($korisnici==null || count($korisnici) == 0){
                    $errors['noUser'] = "Ne postoji korisnik sa tim korisnickim imenom";
                    return $this->prikaz('uvidAdmin',['errors'=>$errors]);
                }
                return $this->prikaz('uvidAdmin',['users'=>$korisnici,'uloga'=>$uloga]);
        }
        else if($uloga == "moderator"){
            $zm = new ZaposleniModel();
                if($sviKorisnici == false)
                    $korisnici = $zm->like('KorisnickoIme', "%".$username."%")->where("Tip",0)->findAll();
                else
                    $korisnici = $zm->where("Tip",0)->findAll();;
                
                if($korisnici==null || count($korisnici) == 0){
                    $errors['noUser'] = "Ne postoji ".$uloga." sa tim korisnickim imenom";
                    return $this->prikaz('uvidAdmin',['errors'=>$errors]);
                }
                return $this->prikaz('uvidAdmin',['users'=>$korisnici,'uloga'=>$uloga]);
        }
        
        else if($uloga == "administrator"){
           $zm = new ZaposleniModel();
                if($sviKorisnici == false)
                    $korisnici = $zm->like('KorisnickoIme', "%".$username."%")->where("Tip",1)->findAll();
                else
                    $korisnici = $zm->where("Tip",1)->findAll();
                
                if($korisnici==null || count($korisnici) == 0){
                    $errors['noUser'] = "Ne postoji ".$uloga." sa tim korisnickim imenom";
                    return $this->prikaz('uvidAdmin',['errors'=>$errors]);
                }
                return $this->prikaz('uvidAdmin',['users'=>$korisnici,'uloga'=>$uloga]);
        }
        
        
        
    }
    
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
        
        return $this->prikaz('uvidIstorijeKorisnika',['korisnik'=>$korisnik,'ruletNiz'=>$ruletNiz,'slotNiz'=>$slotNiz,'luckyNiz'=>$luckyNiz,'sportNiz'=>$sportNiz]);
        
        
        //return $this->prikaz('uvidIstorijeKorisnika',['korisnik'=>$korisnik]);
    }
    
    
    public function azurirajKvotu(){
        $um=new UtakmicaModel();
        $utakmice = $um->findAll();
        $kele=1;
        foreach ($utakmice as $utakmica){
        $kvota1=$this->request->getVar('jedan'.$kele); 
        $kvotaX=$this->request->getVar('iks'.$kele);
        $kvota2=$this->request->getVar('dva'.$kele);        
        $kvote=[];
        
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
        $kele++;    
        }   
        $this->prikaz('kvoteAdmin',[]);
    }
    
    public function dodajRezultat(){
         $tm = new TimModel();        
            $timovi = $tm->findAll();
            $um = new UtakmicaModel();        
            $utakmice = $um->where('Rezultat',"0")->findAll();
        
        $this->prikaz('upisRezultataAdmin',['utakmice'=>$utakmice]);
    }
    
    public function submitRezultat(){
        
        $tiketiZaAzuriranje = [];
        
        $tm = new TimModel();   
        
        $tkm = new TiketKladjenjeModel();
        $tkm->db->transBegin();
        
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->findAll();
        
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
                if($utakmica == null){
                    $tkm->db->transRollback();
                    return;
                }
                
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
        
        $utakmice = $um->where('Rezultat',"0")->findAll();
         $tkm->db->transCommit();
        return $this->prikaz('upisRezultataAdmin',['utakmice'=>$utakmice]);
        
    }
    
}

