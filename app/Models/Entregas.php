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
        'usuario_pedido',
        'usuario_entrega',
        'group_id',
        'firma',
        'action_by',
    ];

    public function group(){

        return $this->belongsTo(Group::class);
    }

    public function user(){

        return $this->belongsTo(User::class, 'action_by');
    }
}
