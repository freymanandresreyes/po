<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AbonoSistecredito extends Model
{
    protected $table = 'abono_sistecredito';

    protected $fillable = ['id_cliente','n_factura','valor'];
}
