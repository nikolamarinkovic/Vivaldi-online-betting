<?php
namespace App\Models;
use CodeIgniter\Model;
class RuletModel extends Model
{
    protected $table      = 'rulet';
    protected $primaryKey = 'IdRulet';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IzvucenBroj', 
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