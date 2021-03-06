<?php

 /*
    Autori:
  *     Marko Gloginja,
  *     Stefan Lukovic
 */

namespace App\Controllers;
use \App\Models\KorisnikModel;
use \App\Models\ZaposleniModel;
use App\Models\TimModel;
use App\Models\UtakmicaModel;

/**
* Gost.php – klasa za funkcionalnosti gosta
*
* @version 1.0
*/

class Gost extends BaseController{
    
    /*
        * Funkcija koja sluzi za prikaz stranica Gosta
        *
        * @param $page, $data
        * 
        * $page - ime stranice na koju idemo, $data - podaci koji se prosledjuju stranici
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view('sablon/header_gost');
        //echo view ("stranice/meniGost");
        echo view ("stranice/$page",$data);
        echo view('sablon/footer');
    }
    
    public function index(){
        $this->prikaz('pocetnaGost',[]);
    }
    public function pocetna(){
        $this->prikaz('pocetnaGost',[]);
    }
    
    /*
        * Funkcija koja sluzi za ispis uspesne prijave
        *
        * @param $poruka
        * 
        * $poruka - poruka koja se ispisuje
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function prijava($poruka = null){
        
        $info = $this->session->getFlashdata('info');
        $this->prikaz('prijava', ['poruka'=>$poruka, 'info'=>$info]);
    }
    
    /*
        * Funkcija koja vrsi proveru postojanja korisnika u bazi
        *
        *legenda: 0-nema korisnika; 1-postoji korisnik; 2-lozinka nije ispravna
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    private function proveraKorisnik() {
        $km = new KorisnikModel();     
        $korisnik = $km
                ->where('KorisnickoIme', $this->request->getVar('username_login'))
                ->first();
        
        if($korisnik==null){
            $errors['KorisnickoIme'] = 'Korisnicko ime ne postoji';
            return 0;// $this->prikaz('prijava',['errors'=>$errors]);
        }
        
        $sifra = $this->request->getVar('password_login');
        
        
        if(!password_verify($sifra, $korisnik->Lozinka)){
            return 2; //$this->prikaz('prijava',['errors'=>$errors]);
        }
        
        $this->session->set('korisnik', $korisnik);
        return 1;//redirect()->to(base_url('Korisnik'));
    }
    
    /*
        * Funkcija koja vrsi proveru postojanja zaposlenog u bazi
        *
        *legenda: 0-nema zaposlenog; 1-postoji zaposlen; 2-lozinka nije ispravna
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
     private function proveraZaposleni() {
         
        $km = new ZaposleniModel();     
        $korisnik = $km
                ->where('KorisnickoIme', $this->request->getVar('username_login'))
                ->first();
        
        if($korisnik==null){
            return 0;
        }
        
        $sifra = $this->request->getVar('password_login');
        if(!password_verify($sifra, $korisnik->Lozinka)){
            //$this->session->set('korisnik', $korisnik);
            return 2;
        }
        
        
        
        if($korisnik->Tip == 0){
            $this->session->set('moderator', $korisnik);
            return 1;
        }
        else{
            $this->session->set('administrator', $korisnik);
            return 3;
        }
    }
    
    /*
        * Funkcija koja vrsi prijavu na sistem
        * 
        * @return redirektuje na pocetnu stranicu odgovarajuceg korisnika/zaposlenog
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
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
    
    /*
        * Funkcija koja vrsi registraciju korisnika ili zaposlenog u bazi podataka
        * 
        * @return redirektuje na stranicu za prijavu korisnika/zaposlenog
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function registration()
    {
        $errors = [];
        $info = "Uspesna registracija";
        if(!$this->validate(['username_registration'=>'required', 
                                'password_registration'=>'required|min_length[8]',
                                'passconfirm_registration'=>'required|matches[password_registration]',
                                'name_registration'=>'required',
                                'surname_registration'=>'required',
                                'id_registration'=>'required|min_length[13]|max_length[13]',
                                'card_registration'=>'required' ])){
            if(!empty($this->validator->getErrors()['username_registration']))
                $errors['KorisnickoIme'] = 'Unesite korisnicko ime';
            if(!empty($this->validator->getErrors()['password_registration']))
                $errors['Lozinka'] = 'Unesite lozinku od barem 8 karaktera';
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
        
        //ddmmggg.......
        $JMBG = $this->request->getVar('id_registration');
        $day = intval(substr($JMBG, 0, 2));
        $month = intval(substr($JMBG, 2, 2));
        $year = substr($JMBG, 4, 3);
        if($year[0]=="9")
            $year = intval($year) + 1000;
        else
            $year = intval($year) + 2000;
        $date1 = mktime (0, 0, 0, $month, $day, $year) ;
        $date2 = strtotime(date("Y-m-d\TH:i")); 
        $diff = $date2 - $date1; 
        $years = floor($diff / (365*60*60*24));        
        if($years < 18){
            $errors['JMBG'] = 'Niste punoletni';
            return $this->prikaz('registracija',['errors'=>$errors]);
        }    
        
        $lozinka = $this->request->getVar('password_registration');
        $hashLozinka = password_hash($lozinka, PASSWORD_DEFAULT);
                
        $km = new KorisnikModel();
        $km->save([ 'KorisnickoIme' => $this->request->getVar('username_registration'),
            'Lozinka'=> $hashLozinka,
            'Ime' => $this->request->getVar('name_registration'),
            'Prezime' => $this->request->getVar('surname_registration'),
            'JMBG' => $this->request->getVar('id_registration'),
            'BrojKartice' => $this->request->getVar('card_registration'),
            'Tokeni' => '0']);

        $this->session->setFlashdata('info',$info);
        //redirect("home/index");

        return redirect()->to(base_url('Gost/prijava'));

    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice za registraciju
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function registracija(){
        $this->prikaz('registracija',[]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice ruleta Gosta
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function rulet(){
        $this->prikaz('ruletGost',[]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice slota Gosta
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function slot(){
        $this->prikaz('slotGost',[]);
    }
    
     /*
        * Funkcija koja sluzi za prikaz stranice lucky6 Gosta
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function lucky6(){
        $this->prikaz('lucky6Gost',[]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz stranice sportskog kladjenja Gosta
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function sport(){
        date_default_timezone_set('Europe/Belgrade');
        $vremeTrenutno = strtotime(date("Y-m-d\TH:i"));
        
        $tm = new TimModel();        
        $timovi = $tm->findAll();
        $um = new UtakmicaModel();        
        $utakmice = $um->where('Rezultat',"0")->where('UNIX_TIMESTAMP(Vreme) > ', $vremeTrenutno - 60*90)->findAll();
        $this->prikaz('sportGost',['timovi'=>$timovi, 'utakmice'=>$utakmice]);
    }
    
    /*
        * Funkcija koja sluzi za prikaz profila Gosta
        * 
        * @return void
        *
        * Autori:
            Marko Gloginja,
            Stefan Lukovic
        
    */
    
    public function profil(){
        $this->prikaz('profilGost',[]);
    }
}
