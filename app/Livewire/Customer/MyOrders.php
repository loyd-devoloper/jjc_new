<?php

namespace App\Livewire\Customer;

use Attribute;
use App\Models\Orders;
use Livewire\Component;
use App\Models\Customer;
use App\Models\OrderItem;
use Filament\Tables\Table;
use Livewire\Attributes\Title;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class MyOrders extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function mount()
    {
        $records = Orders::query()->select('payment_status','paymongo_id','id')->where('customer_id', Auth::guard('customer')->id())->where('payment_status', 'pending')->where('status', 'processing')->get();


        foreach ($records as $record) {
            if ($record->payment_status == 'pending') {

                $api_key = 'sk_test_A8xf234vNneM4gXAv8ZKEDJ2';
                $cout = Http::withHeaders([
                    'authorization' => 'Basic ' . base64_encode($api_key),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])->get('https://api.paymongo.com/v1/checkout_sessions/' . $record->paymongo_id)->json();

                if (isset($cout['data']['attributes']['payments'][0])) {

                    Orders::query()->select('payment_status','paymongo_id','customer_id')->where('id', $record->id)->update([
                        'payment_status' => $cout['data']['attributes']['payments'][0]['attributes']['status']
                    ]);
                    // $record->update([
                    //     'payment_status' => $cout['data']['attributes']['payments'][0]['attributes']['status']
                    // ]);
                }
            }
        }
    }
    public function table(Table $table): Table
    {

        $data = Orders::query()->with('productInfo')->select('ref','payment_status','checkout_url','downpayment','payment_type','status','id','price','paymongo_id')->where('customer_id', Auth::guard('customer')->id());
        return $table
            ->query($data)
            ->paginationPageOptions(['5', '10'])
            ->heading('My Orders')
            ->columns([
                TextColumn::make('ref')->searchable(),
                TextColumn::make('price')->state(function ($record){
                    return !!$record->downpayment ? 'PHP ' . $record->price.' / '.$record->downpayment : 'PHP ' . $record->price;
                } ),
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
                // ...
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->label('View Items')->modalContent(function ($record) {
                        $customerInfo = Customer::where('id',$record->customer_id)->first();
                        $items = OrderItem::with('productInfo')->where('order_id', $record->id)->get();
                        return view('filament.pages.customer-table', ['records' => $items,'customer'=>$customerInfo]);
                    }),
                    Action::make('payment')->label('Pay')
                    ->hidden(fn ($record) => ($record->payment_status == 'pending' && $record->status == 'processing') ? false : true )
                    ->url(function ($record)
                    {

                        if($record->status == 'processing' && $record->payment_status == 'pending')
                        {


                            return $record->checkout_url;
                        }
                    } )->openUrlInNewTab()->icon('heroicon-o-currency-dollar'),
                    DeleteAction::make()->label('Cancel')->icon('heroicon-o-x-mark')->modalHeading('Cancel Order')->modalIcon('heroicon-o-x-mark')->hidden(fn ($record) => ($record->payment_status == 'pending' && $record->status == 'processing') ? false : true )
                    ->action(function($record){
                        $record->update([
                            'status'=>'cancelled'
                        ]);
                    }),
                ])
            ])
            ->bulkActions([
                // ...
            ]);
    }
    #[Title('My Orders')]
    public function render()
    {
        $cart_count = \App\Models\Cart::where('customer_id', Auth::guard('customer')->id())->count();
        return view('livewire.customer.my-orders', compact('cart_count'));
    }
}
