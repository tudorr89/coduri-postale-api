<?php

namespace App\Livewire;

use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Livewire\Component;
use App\Models\Zipcode;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Zipcodes extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Zipcode::query())
            ->columns([
                TextColumn::make('county')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('street')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('zipcode')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('county')
                    ->options(Zipcode::query()->selectRaw('DISTINCT county')->orderby('county','ASC')->pluck('county','county')->toArray())
                    ->searchable()
                    ->preload(),
                SelectFilter::make('city')
                    ->options(Zipcode::query()->selectRaw('DISTINCT city')->orderby('city','ASC')->pluck('city','city')->toArray())
                    ->searchable()
                    ->preload(),
                SelectFilter::make('street')
                    ->options(Zipcode::query()->selectRaw('DISTINCT street')->orderby('street','ASC')->pluck('street','street')->toArray())
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render(): View
    {
        return view('livewire.zipcodes');
    }
}
