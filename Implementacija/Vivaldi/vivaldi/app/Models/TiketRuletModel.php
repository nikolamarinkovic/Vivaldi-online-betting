<?php

/*
 * TiketRuletModel.php – model tiketa ruleta u bazi podataka
*
* @version 1.0
    Autor:
  *     Marko Lisicic
*/

namespace App\Models;
use CodeIgniter\Model;
class TiketRuletModel extends Model
{
    protected $table      = 'tiket_rulet';
    protected $primaryKey = 'IdRulet IdKorisnik';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdRulet',
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