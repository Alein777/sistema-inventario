<?php
namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;
class Bitacora extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'bitacora';
    protected $fillable = [
        'tabla', 'accion', 'id_registro',
        'valores_old', 'valores_new', 'id_user'
    ];
}