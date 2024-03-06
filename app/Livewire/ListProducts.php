<?php

namespace App\Livewire;

use App\Models\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ListProducts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->select('*')
                    ->selectRaw('COUNT(*) as products_count')
                    ->groupBy('id')
            )
            ->columns([
                TextColumn::make('type'),
                TextColumn::make('products_count')->label('Total Products'),
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-products');
    }
}
