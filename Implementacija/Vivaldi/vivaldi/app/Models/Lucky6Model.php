<?php
namespace App\Models;
use CodeIgniter\Model;
class Lucky6Model extends Model
{
    protected $table      = 'lucky6';
    protected $primaryKey = 'IdLucky6';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IzvuceniBrojevi', 
        'Vreme'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}