<?php

/*
 * UtakmicaModel.php – model utakmice u bazi podataka
*
* @version 1.0
    Autor:
  *     Nikola Marinkovic
*/

namespace App\Models;
use CodeIgniter\Model;
class UtakmicaModel extends Model
{
    protected $table      = 'utakmica';
    protected $primaryKey = 'IdUtakmica	';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'Rezultat', 
        'Vreme', 
        'IdDomacin', 
        'IdGost', 
        'KvotaX', 
        'Kvota1' , 
        'Kvota2'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    public $ImeDomacin;
    public $ImeGost;
    
}