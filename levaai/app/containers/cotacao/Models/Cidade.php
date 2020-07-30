<?php

namespace Cotacao\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cadcid';

    protected $primaryKey = 'codigo_cid';

    public $timestamps = false;

    public function __construct(
        
    )
    {
        
    }
}