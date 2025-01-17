<?php

namespace App\Enums;

enum ProductStatus: string
{
    case Ativo = 'Ativo';
    case Inativo = 'Inativo';

    public static function options(): array
    {
        return [
            self::Ativo->value => 'Ativo',
            self::Inativo->value => 'Inativo',
        ];
    }
}
