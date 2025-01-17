<div>
    <div>
        <select wire:model="statusFilter" class="form-control mb-2">
            <option value="">Todos</option>
            @foreach (\App\Enums\ProductStatus::labels() as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>

        <input
            type="text"
            wire:model.debounce.500ms="search"
            placeholder="Buscar produtos..."
            class="form-control"
        />

        <ul class="list-group mt-2">
            @forelse ($produtos as $produto)
                <li class="list-group-item">
                    {{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}
                </li>
            @empty
                <li class="list-group-item">Nenhum produto encontrado.</li>
            @endforelse
        </ul>
    </div>

    <input
        type="text"
        wire:model.debounce.500ms="search"
        placeholder="Buscar produtos..."
        class="form-control"
    />

    <ul class="list-group mt-2">
        @forelse ($produtos as $produto)
            <li class="list-group-item">
                {{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </li>
        @empty
            <li class="list-group-item">Nenhum produto encontrado.</li>
        @endforelse
    </ul>
</div>
