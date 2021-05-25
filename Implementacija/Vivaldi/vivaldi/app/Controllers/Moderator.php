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
use App\Models\UtakmicaModel;
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
    
    public function dodajUtakmicu(){
        $errors = [];
        if(!$this->validate(['kvota1'=>'required',
                            'kvotaX'=>'required',            
                            'kvota2'=>'required',
                            'vreme'=>'required'])){
            if(!empty($this->validator->getErrors()['kvota1']))
                $errors['Kvota1'] = 'Unesite kvotu za rezultat 1';
            if(!empty($this->validator->getErrors()['kvotaX']))
                $errors['KvotaX'] = 'Unesite kvotu za rezultat X';
            if(!empty($this->validator->getErrors()['kvota2']))
                $errors['Kvota2'] = 'Unesite kvotu za rezultat 2';
            if(!empty($this->validator->getErrors()['vreme']))
                $errors['Vreme'] = 'Izaberite vreme';
            
            return $this->prikaz('utakmicaModerator',['errors'=>$errors]);
        }       
     
        $um = new UtakmicaModel();   
        $kvota1=$this->request->getVar('kvota1');
        $kvota2=$this->request->getVar('kvota2');
        $kvotaX=$this->request->getVar('kvotaX');
        $idDomacin=$this->request->getVar('domacin');
        $idGost=$this->request->getVar('gost');
        if($idDomacin==$idGost)
             $errors['Teams='] = 'Timovi moraju biti razliciti';
        if($kvota1<1)
             $errors['Kvota1-'] = 'Kvota mora biti veca od 1';
        if($kvotaX<1)
             $errors['KvotaX-'] = 'Kvota mora biti veca od 1';
        if($kvota2<1)
             $errors['Kvota2-'] = 'Kvota mora biti veca od 1';
        if(!empty($errors))
            return $this->prikaz('utakmicaModerator',['errors'=>$errors]);
        $um->save([ 'Rezultat' => "0",
                'Vreme'=> $this->request->getVar('vreme'),
                'IdDomacin' => $idDomacin,
                'IdGost' => $idGost,
                'KvotaX' => $kvotaX,
                'Kvota1' => $kvota1,
                'Kvota2' => $kvota2]);
        return $this->prikaz('utakmicaModerator',[]);
    }

    public function azurirajKvotu(){
        $um=new UtakmicaModel();
        $utakmice = $um->findAll();
        $kele=1;
        foreach ($utakmice as $utakmica){
        $kvota1=$this->request->getVar('jedan'.$kele); 
        $kvotaX=$this->request->getVar('iks'.$kele);
        $kvota2=$this->request->getVar('dva'.$kele);        
        $kvote=[];
        
            if(!empty($kvota1)&&($kvota1!=$utakmica->Kvota1)){
                $kvote['Kvota1']=$kvota1;                
            }
            if(!empty($kvota2)&&($kvota2!=$utakmica->Kvota2)){
                $kvote['Kvota2']=$kvota2;
            }
            if(!empty($kvotaX)&&($kvotaX!=$utakmica->KvotaX)){
                $kvote['KvotaX']=$kvotaX;
            }
            if(!empty($kvote)){
                $um->update($utakmica->IdUtakmica, $kvote);
            }
        $kele++;    
        }   
        $this->prikaz('kvoteModerator',[]);
    }
}
