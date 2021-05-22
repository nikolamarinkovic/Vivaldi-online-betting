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
 * Description of Gost
 *
 * @author Marko
 */
class Gost extends BaseController{
    //put your code here
    
    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view('sablon/header_gost');
        echo view ("stranice/meniGost");
        echo view ("stranice/$page",$data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetna',[]);
    }
    public function pocetna(){
        $this->prikaz('pocetna',[]);
    }
    
    public function prijava($poruka = null){
        $this->prikaz('prijava', ['poruka'=>$poruka]);
    }
    //0 nema korrisnika
    //1 ima korisnika
    //2 los password
    private function proveraKorisnik() {
        $km = new KorisnikModel();     
        $korisnik = $km
                ->where('KorisnickoIme', $this->request->getVar('username_login'))
                ->first();
        
        if($korisnik==null){
            $errors['KorisnickoIme'] = 'Korisnicko ime ne postoji';
            return 0;// $this->prikaz('prijava',['errors'=>$errors]);
        }
        if($korisnik->Lozinka != $this->request->getVar('password_login')){
            
            return 2; //$this->prikaz('prijava',['errors'=>$errors]);
        }
        
        $this->session->set('korisnik', $korisnik);
        return 1;//redirect()->to(base_url('Korisnik'));
    }
     private function proveraZaposleni() {
        $km = new ZaposleniModel();     
        $korisnik = $km
                ->where('KorisnickoIme', $this->request->getVar('username_login'))
                ->first();
        
        if($korisnik==null){
            return 0;
        }
        if($korisnik->Lozinka != $this->request->getVar('password_login')){
            return 2;
        }
        
        $this->session->set('korisnik', $korisnik);
        
        if($korisnik->Tip == 0){
            $this->session->set('moderator', $korisnik);
            return 1;
        }
        else{
            $this->session->set('administrator', $korisnik);
            return 3;
        }
    }
    public function login(){
        $errors = [];
        if(!$this->validate(['username_login'=>'required', 'password_login'=>'required' ])){
            if(!empty($this->validator->getErrors()['username_login']))
                $errors['KorisnickoIme'] = 'Unesite korisnicko ime';
            if(!empty($this->validator->getErrors()['password_login']))
                $errors['Lozinka'] = 'Unesite lozinku';
            
            return $this->prikaz('prijava',['errors'=>$errors]);
        }
        
        $status = $this->proveraKorisnik();
        if($status == 1){
            return redirect()->to(base_url('Korisnik'));
        }
        if($status == 2){
            $errors['Lozinka'] = 'Lozinka nije dobra';
            return $this->prikaz('prijava',['errors'=>$errors]);
        }
        
        $status = $this->proveraZaposleni();
        if($status == 1){
            return redirect()->to(base_url('Moderator'));
        }
        if($status == 2){
            $errors['Lozinka'] = 'Lozinka nije dobra';
            return $this->prikaz('prijava',['errors'=>$errors]);
        }
        if($status == 0){
            $errors['KorisnickoIme'] = 'Korisnicko ime ne postoji';
            return $this->prikaz('prijava',['errors'=>$errors]);
        }
        if($status == 3){
            return redirect()->to(base_url('Administrator'));
        }
        
       
    }
    
    public function registration()
    {
        $errors = [];
        if(!$this->validate(['username_registration'=>'required', 
                                'password_registration'=>'required',
                                'passconfirm_registration'=>'required|matches[password_registration]',
                                'name_registration'=>'required',
                                'surname_registration'=>'required',
                                'id_registration'=>'required|min_length[13]|max_length[13]',
                                'card_registration'=>'required' ])){
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
            if(!empty($this->validator->getErrors()['card_registration']))
                $errors['BrojKartice'] = 'Unesite broj kartice';
            
            
        
            return $this->prikaz('registracija',['errors'=>$errors]);
        }
        
        
       
           $km = new KorisnikModel();
           $km->save([ 'KorisnickoIme' => $this->request->getVar('username_registration'),
               'Lozinka'=> $this->request->getVar('password_registration'),
               'Ime' => $this->request->getVar('name_registration'),
               'Prezime' => $this->request->getVar('surname_registration'),
               'JMBG' => $this->request->getVar('id_registration'),
               'BrojKartice' => $this->request->getVar('card_registration'),
               'Tokeni' => '0']);
           
           return redirect()->to(base_url('Gost/prijava'));
       
    }
    
    public function registracija(){
        $this->prikaz('registracija',[]);
    }
    
    public function rulet(){
        $this->prikaz('ruletGost',[]);
    }
    
    public function slot(){
        $this->prikaz('slotGost',[]);
    }
    
    public function lucky6(){
        $this->prikaz('lucky6Gost',[]);
    }
    
    public function sport(){
        $this->prikaz('sportGost',[]);
    }
    
    public function profil(){
        $this->prikaz('profilGost',[]);
    }
}