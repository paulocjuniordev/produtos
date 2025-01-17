<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Ativo = 'Ativo';
    case Inativo = 'Inativo';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
