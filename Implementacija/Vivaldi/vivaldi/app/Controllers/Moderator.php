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
        $this->prikaz('ruletModerator',[]);
    }
    
    public function slot(){
        $this->prikaz('slotModerator',[]);
    }
    
    public function lucky6(){
        $this->prikaz('lucky6Moderator',[]);
    }
    
    public function sport(){
        $this->prikaz('sportModerator',[]);
    }
    
    public function profil(){
        $this->prikaz('profilModerator',[]);
    }
    
    public function utakmica(){
        $this->prikaz('utakmicaModerator',[]);
    }
    
    public function kvote(){
        $this->prikaz('kvoteModerator',[]);
    }
    
    public function tim(){
        $this->prikaz('timModerator',[]);
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
        return redirect()->to(base_url('Moderator/rulet'));     
    }

}
