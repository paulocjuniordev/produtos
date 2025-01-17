<?php

namespace App\Http\Livewire;

use App\Models\Produto;
use Livewire\Component;

class ProductSearch extends Component
{
    public $search = '';
    public $statusFilter = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => null],
    ];

    public function render()
    {
        $produtos = Produto::query()
            ->when($this->search, function ($query) {
                $query->where('nome', 'like', '%' . $this->search . '%')
                    ->orWhere('descricao', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->get();

        return view('livewire.product-search', compact('produtos'));
    }
}
