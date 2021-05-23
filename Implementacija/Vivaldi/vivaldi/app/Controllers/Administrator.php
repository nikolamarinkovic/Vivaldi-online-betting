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
        //$um = new UtakmicaModel();     
        /*$utakmica = $um
                ->where('', $this->request->getVar('tim_ime'))
                ->first();
        if($tim != null){
            $errors['TimIme'] = 'Tim vec postoji';
            return $this->prikaz('timAdmin',['errors'=>$errors]);
        }*/
        //$um->save(['IdDomacin' => $this->request->getVar('Domacin')]);
        return redirect()->to(base_url('Administrator/utakmica'));     
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
    
    
    
    
}

