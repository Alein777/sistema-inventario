<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Municipio extends Model
{
    protected $fillable = ['nombre', 'id_departamento'];
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }
}