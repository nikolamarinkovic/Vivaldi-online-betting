<?php

/*
 * TiketSlotModel.php – model tiketa slota u bazi podataka
*
* @version 1.0
    Autor:
  *     Marko Lisicic
*/

namespace App\Models;
use CodeIgniter\Model;
class TiketSlotModel extends Model
{
    protected $table      = 'tiket_slot';
    protected $primaryKey = 'IdTiketSlot';
    protected $useAutoIncrement = true;
    protected $returnType     = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'IdKorisnik',
        'Ulog',
        'Dobitak',
        'Rezultat'
        ];
    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    
}