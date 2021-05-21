<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

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
        $this->prikaz('odjavaAdmin',[]);
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
    
    
    
    
    
}
