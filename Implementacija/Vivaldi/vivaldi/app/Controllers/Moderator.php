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
 * Description of Moderator
 *
 * @author Marko
 */
class Moderator extends BaseController{
    protected function prikaz($page, $data) {
        $data['controller']='Moderator';
        echo view('sablon/header_moderator');
        echo view ("stranice/meniModerator");
        echo view ("stranice/$page", $data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetnaModerator',[]);
    }
    
    public function pocetna(){
        $this->prikaz('pocetnaModerator',[]);
    }
    
    public function odjava(){
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
    
    
    public function rulet(){
        $this->prikaz('ruletModerator',[]);
    }
    
    public function slot(){
        $this->prikaz('slotModerator',[]);
    }
    
    public function lucky6(){
        $this->prikaz('lucky6Moderator',[]);
    }
    
    public function sport(){
            $tm = new TimModel();        
            $timovi = $tm->findAll();
            $um = new UtakmicaModel();        
            $utakmice = $um->where('Rezultat',"0")->findAll();
        $this->prikaz('sportModerator',['timovi'=>$timovi, 'utakmice'=>$utakmice]);
    }
    
//    public function profil(){
//        $km = new KorisnikModel();
//        $korIme = $this->session->get('korisnik')->KorisnickoIme;
//        $korisnik = $km
//                    ->where('KorisnickoIme', $korIme)
//                    ->first();
//        //var_dump($korIme);
//  
//        $this->prikaz('profilKorisnik',['korisnik'=>$korisnik]);
//    }
    
    public function profil(){
        $zm = new ZaposleniModel();
        $korIme = $this->session->get('moderator')->KorisnickoIme;
        $zaposleni = $zm
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        $this->prikaz('profilModerator',["zaposlen"=>$zaposleni]);
    }
    
    public function promenaLozinke(){
        $errors=[];
        $zm = new ZaposleniModel();
        $korIme = $this->session->get('moderator')->KorisnickoIme;
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
            return $this->prikaz('profilModerator',['errors'=>$errors, 'zaposlen'=>$zaposlen]);
        $lozinka['Lozinka']=password_hash($nova, PASSWORD_DEFAULT);
        $zm->update($zaposlen->IdZaposleni, $lozinka);
        $this->prikaz('profilModerator',['zaposlen'=>$zaposlen,"uspesno"=>"Sifra uspesno promenjena!"]);
    }
    
    public function utakmica(){
        $this->prikaz('utakmicaModerator',[]);
    }
    
    public function kvote(){
        $this->prikaz('kvoteModerator',[]);
    }
    
    public function tim(){
        $uspeh = $this->session->getFlashdata('uspesno');
        $this->prikaz('timModerator',["uspeh"=>$uspeh]);
    }
    public function dodajTim(){  
        if(!$this->validate(['tim_ime'=>'required'])){
            if(!empty($this->validator->getErrors()['tim_ime']))
                $errors['TimIme'] = 'Unesite ime tima';
            //echo var_dump($errors);                 //NE RADI 
            return $this->prikaz('timModerator',['errors'=>$errors]);
        }
        $tm = new TimModel();     
        $tim = $tm
                ->where('Ime', $this->request->getVar('tim_ime'))
                ->first();
        if($tim != null){
            $errors['TimIme'] = 'Tim vec postoji';
            return $this->prikaz('timModerator',['errors'=>$errors]);
        }
        $tm->save(['Ime' => $this->request->getVar('tim_ime')]);
        $this->session->setFlashdata('uspesno',"Tim uspesno postavljen!");
        return redirect()->to(base_url('Moderator/tim'));     
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
            
            return $this->prikaz('utakmicaModerator',['errors'=>$errors]);
        }       
        date_default_timezone_set('Europe/Belgrade');
        
        $um = new UtakmicaModel();   
        $kvota1=$this->request->getVar('kvota1');
        $kvota2=$this->request->getVar('kvota2');
        $kvotaX=$this->request->getVar('kvotaX');
        $idDomacin=$this->request->getVar('domacin');
        $idGost=$this->request->getVar('gost');
        $vreme = $this->request->getVar('vreme');        
        $vremeTest = date("Y-m-d\TH:i");

        if($idDomacin==$idGost)
             $errors['Teams='] = 'Timovi moraju biti razliciti';
        if($kvota1<1)
             $errors['Kvota1-'] = 'Kvota mora biti veca od 1';
        if($kvotaX<1)
             $errors['KvotaX-'] = 'Kvota mora biti veca od 1';
        if($kvota2<1)
             $errors['Kvota2-'] = 'Kvota mora biti veca od 1';
        if($vreme<$vremeTest)
             $errors['Vreme'] = 'Vreme utakmice nevalidno!';
        if(!empty($errors))
            return $this->prikaz('utakmicaModerator',['errors'=>$errors]);
        
        $um->save([ 'Rezultat' => "0",
                'Vreme'=> $this->request->getVar('vreme'),
                'IdDomacin' => $idDomacin,
                'IdGost' => $idGost,
                'KvotaX' => $kvotaX,
                'Kvota1' => $kvota1,
                'Kvota2' => $kvota2]);
        return $this->prikaz('utakmicaModerator',["uspesno"=>"Utakmica uspesno dodata!"]);
    }

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
            return $this->prikaz('kvoteModerator',['errors'=>$errors]);
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
        $this->prikaz('kvoteModerator',["uspesno"=>"Kvote uspesno promenjene!"]);
    }
    
    public function dodajRezultat(){
        date_default_timezone_set('Europe/Belgrade');
        $vremeTrenutno = strtotime(date("Y-m-d\TH:i"));
        $tm = new TimModel();       
        $timovi = $tm->findAll();
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) < ', $vremeTrenutno - 60*90)->findAll();
        
        $this->prikaz('upisRezultataModerator',['utakmice'=>$utakmice]);
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
            return $this->prikaz('upisRezultataModerator',['errors'=>$errors, 'utakmice'=>$utakmice]);
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
        return $this->prikaz('upisRezultataModerator',['utakmice'=>$utakmice,"uspesno"=>"Rezultat uspesno upisan!"]);
        
    }
}
