<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Korisnik
 *
 * @author Marko
 */
class Korisnik extends BaseController{
    //put your code here
    
    protected function prikaz($page, $data) {
        $data['controller']='Korisnik';
        echo view('sablon/header_korisnik');
        echo view ("stranice/meniKorisnik");
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
        $data['controller']='Gost';
        $this->prikaz('pocetna',[]);

    }
    
    public function rulet(){
        $this->prikaz('ruletKorisnik',[]);
    }
    
    public function slot(){
        $this->prikaz('slotKorisnik',[]);
    }
    
    public function lucky6(){
        $this->prikaz('lucky6Korisnik',[]);
    }
    
    public function sport(){
        $this->prikaz('sportKorisnik',[]);
    }
    
    public function profil(){
        $this->prikaz('profilKorisnik',[]);
    }
}
