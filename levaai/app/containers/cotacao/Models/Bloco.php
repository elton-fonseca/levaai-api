<?php

namespace Cotacao\Models;

use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{
    protected $table = 'cadblo';

    protected $primaryKey = 'codigo_blo';

    public $timestamps = false;

    public function __construct(
        
    )
    {
        
    }
}