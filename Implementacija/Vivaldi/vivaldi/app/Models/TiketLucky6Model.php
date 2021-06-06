<?php

/*
 * TiketLucky6Model.php – model tiketa igre lucky6 u bazi podataka
*
* @version 1.0
    Autor:
  *     Marko Lisicic
*/

namespace App\Models;
use CodeIgniter\Model;
class TiketLucky6Model extends Model
{
    protected $table      = 'tiket_lucky6';
    protected $primaryKey = 'IdKorisnik IdLucky6';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdKorisnik', 
        'IdLucky6', 
        'Ulog', 
        'Dobitak', 
        'Kombinacija'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}