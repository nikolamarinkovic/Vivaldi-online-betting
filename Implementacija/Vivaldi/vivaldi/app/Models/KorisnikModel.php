<?php
namespace App\Models;
use CodeIgniter\Model;
class KorisnikModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'IdKorisnik';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'Ime', 
        'Prezime', 
        'Lozinka', 
        'KorisnickoIme', 
        'JMBG', 
        'BrojKartice' , 
        'Tokeni'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}