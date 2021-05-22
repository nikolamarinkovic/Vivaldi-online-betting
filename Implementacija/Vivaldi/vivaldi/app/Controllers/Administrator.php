<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \App\Models\KorisnikModel;
use \App\Models\ZaposleniModel;

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
    public function modadm(){
        $this->prikaz('modadmAdmin',[]);
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

