<?php
namespace App\Models;
use CodeIgniter\Model;
class KorisnikModel extends Model
{
    protected $table      = 'tim';
    protected $primaryKey = 'IdTim	';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'Ime'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}