<?php
namespace App\Models;
use CodeIgniter\Model;
class StavkaTiketModel extends Model
{
    protected $table      = 'stavka_tiket';
    protected $primaryKey = 'IdTiketKladjenje IdUtakmica';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdTiketKladjenje',
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