<?php
namespace App\Models;
use CodeIgniter\Model;
class TiketKladjenjeModel extends Model
{
    protected $table      = 'tiket_kladjenje';
    protected $primaryKey = 'IdTiketKladjenje';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdKor', 
        'Ulog', 
        'Dobitak', 
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