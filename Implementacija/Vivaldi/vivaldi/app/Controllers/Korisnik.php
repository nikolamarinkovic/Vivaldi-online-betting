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
        $coef = 0;
        
        $tokeni = intval($this->request->getVar('Tokeni'));
        $num1 = rand(0,7);
        $num2 = rand(0,7);
        $num3 = rand(0,7);
        //begin trans
        $km = new KorisnikModel();
        $korIme = $this->session->get('korisnik')->KorisnickoIme;
        $Korisnik = $km
                    ->where('KorisnickoIme', $korIme)
                    ->first();
        
        if($tokeni != 0 && $Korisnik->Tokeni > $tokeni){
            $Korisnik->Tokeni -= $tokeni;
            $dobitak = 0;
            
            if($num1==6 && $num2==6 && $num3==6)
                $coef = 500;
            else if($num1==4 && $num2==4 && $num3==4)
                $coef = 250;
            else if($num1==1 && $num2==1 && $num3==1)
                $coef = 150;
            else if($num1==7 && $num2==7 && $num3==7)
                $coef = 100;
            else if($num1==4 && $num2==7 && $num3==1)
                $coef = 80;
            else if($num1==2 && $num2==2 && $num3==2)
                $coef = 80;
            else if($num1==2 && $num2==2)
                $coef = 50;
            else if($num1==3 && $num2==3 && $num3==3)
                $coef = 50;
            else if($num1==3 && $num2==3)
                $coef = 40;
            else if($num1==0 && $num2==0 && $num3==0)
                $coef = 30;
            else if($num1==0 && $num2==0)
                $coef = 15;
            else if($num1==5 && $num2==5 && $num3==5)
                $coef = 10;
            else if($num1==5 && $num2==5)
                $coef = 5;
            else if($num1==5)
                $coef = 2;
            
            
            
            $Korisnik->Tokeni += $tokeni * $coef;
            $dobitak = $tokeni * $coef;
            
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
        }
        //end trans
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
