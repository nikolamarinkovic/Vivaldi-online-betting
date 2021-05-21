<?php
namespace App\Models;
use CodeIgniter\Model;
class ZaposleniModel extends Model
{
    protected $table      = 'zaposleni';
    protected $primaryKey = 'IdZaposleni';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'Ime', 
        'Prezime', 
        'Lozinka', 
        'KorisnickoIme', 
        'JMBG', 
        'Tip'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}