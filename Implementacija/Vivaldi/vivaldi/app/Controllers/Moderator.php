<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Moderator
 *
 * @author Marko
 */
class Moderator extends BaseController{
    protected function prikaz($page, $data) {
        $data['controller']='Administrator';
        echo view('sablon/header_moderator');
        echo view ("stranice/meniModerator");
        echo view ("stranice/$page");
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

}
