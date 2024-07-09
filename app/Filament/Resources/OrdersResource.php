<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Orders;
use App\Models\Customer;
use Filament\Forms\Form;
use App\Models\OrderItem;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrdersResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrdersResource\RelationManagers;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    // public function query()

    // {

    //     return Orders::with('customerInfo')

    //         ->withSearchable([

    //             'customerInfo.email',
    //             'customerInfo.fullname',

    //         ]);

    // }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ref')->searchable(),
                TextColumn::make('customerInfo.fullname')->searchable(),
                TextColumn::make('customerInfo.email')->searchable(),
                TextColumn::make('price')->state(function ($record) {
                    return !!$record->downpayment ? 'PHP ' . $record->price . ' / ' . $record->downpayment : 'PHP ' . $record->price;
                }),
                TextColumn::make('payment_type')->state(function ($record) {

                    return $record->payment_type;
                }),
                TextColumn::make('payment_status')
                    ->label(new HtmlString('<h1 style="font-weight:bold">Payment Status</h1>'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                    })->icon(fn ($state): string => match ($state) {
                        'pending' => 'heroicon-o-arrow-path',
                        'paid' => 'heroicon-o-check'
                    }),
                TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                    })->icon(fn ($state): string => match ($state) {
                        'processing' => 'heroicon-o-arrow-path',
                        'shipped' => 'heroicon-o-truck',
                        'delivered' => 'heroicon-o-check',
                        'cancelled' => 'heroicon-o-x-mark',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->label('View Items')->modalContent(function ($record) {

                        $items = OrderItem::with('productInfo')->where('order_id', $record->id)->get();
                        $customerInfo = Customer::where('id',$record->customer_id)->first();
                        return view('filament.pages.customer-table', ['records' => $items,'customer'=>$customerInfo]);
                    }),
                    Tables\Actions\EditAction::make()->label('Change Status')
                    ->color(Color::Green)
                    ->form([
                        Select::make('status')->options([
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled
                        ',
                        ])
                    ])->action(function($data,$record){
                        $record->update([
                            'status'=>$data['status']
                        ]);
                        Notification::make()
                        ->title('Saved successfully')
                        ->success()
                        ->send();
                    })->modalWidth(MaxWidth::Small)->modalHeading('Change Status'),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrders::route('/create'),
            // 'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }
}
