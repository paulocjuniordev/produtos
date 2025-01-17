<?php

namespace App\Observers;

use App\Models\Produto;

class ProdutoObserver
{
    /**
     * Handle the Produto "created" event.
     */
    public function created(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "updated" event.
     */
    public function updated(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "deleted" event.
     */
    public function deleted(Produto $produto): void
    {
        if ($produto->status === 'Ativo') {
            throw new \Exception('Não é possível excluir um produto ativo.');
        }
    }

    /**
     * Handle the Produto "restored" event.
     */
    public function restored(Produto $produto): void
    {
        $produto->update(['status' => 'Inativo']);
    }

    /**
     * Handle the Produto "force deleted" event.
     */
    public function forceDeleted(Produto $produto): void
    {
        //
    }
}
