<?php

/*
 * StavkaRuletModel.php – model stavke ruleta u bazi podataka
*
* @version 1.0
    Autor:
  *     Stefan Lukovic
*/

namespace App\Models;
use CodeIgniter\Model;
class StavkaRuletModel extends Model
{
    protected $table      = 'stavka_rulet';
    protected $primaryKey = 'IdStavkaRulet';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdRulet', 
        'IdKorisnik', 
        'Tip', 
        'Prosla',
        'Ulog'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}