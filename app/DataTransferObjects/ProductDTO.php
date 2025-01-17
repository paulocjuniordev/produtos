<?php

namespace App\DataTransferObjects;

class ProductDTO
{
    public function __construct(
        public string $nome,
        public string $descricao,
        public float $preco,
        public string $status
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->nome,
            $request->descricao,
            $request->preco,
            $request->status
        );
    }
}
