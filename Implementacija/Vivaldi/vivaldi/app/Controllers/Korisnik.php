<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;
use \App\Models\KorisnikModel;
use \App\Models\TiketSlotModel;
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
        $this->prikaz('ruletKorisnik',[]);
    }
    
    public function spin(){
        $coef = 2;
        
        $tokeni = intval($this->request->getVar('Tokeni'));
        
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        if($Korisnik->Tokeni < $tokeni){
            echo '0,0,0,'.$Korisnik->Tokeni;
            return;
        }
        $Korisnik->Tokeni -= $tokeni;
        
        $num1 = rand(1,1);
        $num2 = rand(1,1);
        $num3 = rand(1,1);
        $dobitak = 0;
        if($num1 == $num2 && $num2 == $num3){
            //begin trans
            $Korisnik->Tokeni += $tokeni * $coef;
            $dobitak = $tokeni * $coef;
            //end trans
        }
        $km->set("Tokeni",$Korisnik->Tokeni)
                    ->where('KorisnickoIme', $Korisnik->KorisnickoIme)
                    ->update();
        $tsm = new TiketSlotModel();
        $tsm->save([
        'IdKorisnik' => $Korisnik->IdKorisnik,
        'Ulog' => $tokeni,
        'Dobitak' => $dobitak,
        'Rezultat' => $num1 . "," . $num2 . "," . $num3
        ]);
        
        
        echo $num1 . "," . $num2 . "," . $num3 . "," . $Korisnik->Tokeni;
        
    }
    
    public function slot(){
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        $this->prikaz('slotKorisnik',['Tokeni'=>$Korisnik->Tokeni]);
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
