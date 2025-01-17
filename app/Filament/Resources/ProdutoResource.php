<?php

namespace App\Filament\Resources;

use App\Enums\ProductStatus;
use App\Filament\Resources\ProdutoResource\Pages;
use App\Models\Produto;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\BadgeColumn;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('descricao')
                    ->required()
                    ->maxLength(500),
                TextInput::make('preco')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options(ProductStatus::options())
                    ->required()
                    ->default(ProductStatus::Ativo->value),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('descricao')->limit(50),
                Tables\Columns\TextColumn::make('preco')->sortable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'ativo',
                        'danger' => 'inativo',
                        'warning' => 'pendente',
                    ])
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'ativo' => 'Ativo',
                            'inativo' => 'Inativo',
                            'pendente' => 'Pendente',
                            default => 'Desconhecido',
                        };
                    }),

            ])
            ->filters([
                Filter::make('status')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options(ProductStatus::options())
                            ->placeholder('Todos'),
                    ])
                    ->query(fn ($query, $data) => $query->when(
                        $data['status'],
                        fn ($query, $status) => $query->where('status', $status)
                    )),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
