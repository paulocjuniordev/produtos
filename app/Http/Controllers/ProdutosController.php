<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ProductDTO;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
            'preco' => 'required|numeric|min:0',
            'status' => 'required|in:Ativo,Inativo',
        ]);

        $dto = ProductDTO::fromRequest($request);

        Produto::create([
            'nome' => $dto->nome,
            'descricao' => $dto->descricao,
            'preco' => $dto->preco,
            'status' => $dto->status,
        ]);

        return redirect()->back()->with('success', 'Produto criado com sucesso!');
    }
}
