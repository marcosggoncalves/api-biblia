<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = ['posicao', 'nome', 'abreviacao', 'testamento_id'];

    public function testamento()
    {
        return $this->belongsTo(Testamento::class);
    }

    public function versiculos()
    {
        return $this->hasMany(versiculo::class);
    }
}
