<?php
namespace App\Models;
use CodeIgniter\Model;
class KorisnikModel extends Model
{
    protected $table      = 'stavka_tiket';
    protected $primaryKey = 'IdTiketKladjenje';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdUtakmica', 
        'Iznos', 
        'KonacanIshod', 
        'Status'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}