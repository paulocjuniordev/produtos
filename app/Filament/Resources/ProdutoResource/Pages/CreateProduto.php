<?php

namespace App\Filament\Resources\ProdutoResource\Pages;

use App\DataTransferObjects\ProductDTO;
use App\Filament\Resources\ProdutoResource;
use App\Models\Produto;
use Filament\Resources\Pages\CreateRecord;

class CreateProduto extends CreateRecord
{
    protected static string $resource = ProdutoResource::class;

    protected function handleRecordCreation(array $data): Produto
    {
        $dto = new ProductDTO(...$data);

        return Produto::create([
            'nome' => $dto->nome,
            'descricao' => $dto->descricao,
            'preco' => $dto->preco,
            'status' => $dto->status,
        ]);
    }
}
