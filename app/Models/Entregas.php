<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido',
        'linea',
        'descripcion',
        'cantidad',
        'factura',
        'usuario_pedido',
        'usuario_entrega',
        'group_id',
        'firma',
        'evidencia',
        'action_by',
        'codigo_entrega',
    ];
}
