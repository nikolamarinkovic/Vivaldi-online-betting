<?php
namespace App\Models;
use CodeIgniter\Model;
class TiketRuletModel extends Model
{
    protected $table      = 'tiket_rulet';
    protected $primaryKey = 'IdRulet';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdKorisnik', 
        'Ulog', 
        'Dobitak'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}