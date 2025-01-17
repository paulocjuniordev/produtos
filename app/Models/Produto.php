<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'status'
    ];

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($produto) {
            $produto->validate();
        });

        static::updating(function ($produto) {
            $produto->validate();
        });
    }

    public function validate()
    {
        $validator = \Validator::make($this->attributes, [
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
            'preco' => 'required|numeric|min:0',
            'status' => 'required|in:Ativo,Inativo',
        ]);
    }
}
