<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

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
        echo view ("stranice/$page");
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetna',[]);
    }
    public function pocetna(){
        $this->prikaz('pocetna',[]);
    }
    
    public function prijava(){
        $this->prikaz('prijava',[]);
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
