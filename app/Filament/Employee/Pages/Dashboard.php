<?php

namespace App\Filament\Employee\Pages;

use App\Models\Category;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class Dashboard extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $model = Category::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                ->form([
                    TextInput::make('name')
                ])->action(function($data,$record){
                    DB::table('categories')->where('id',$record->id)
                    ->update([
                        'name'=>$data['name']
                    ]);
                    Notification::make()
                    ->title('Updated successfully')
                    ->success()
                    ->send();
                })->color(Color::Amber),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
