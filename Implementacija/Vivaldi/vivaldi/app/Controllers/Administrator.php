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
        $this->prikaz('odjava',[]);
    }
}
