<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use Filament\Actions;
use App\Models\Employee;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\EmployeeResource;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create employee')->form([
                TextInput::make('name')->required(),
                TextInput::make('email')->required(),
                TextInput::make('password')->password()->revealable()->required(),
            ])->action(function($data){

                Employee::create([
                    'name'=>$data['name'],
                    'email'=>$data['email'],
                    'password'=>Hash::make($data['password']),
                ]);
                Notification::make()
                ->title('Created successfully')
                ->success()
                ->send();
            }),
        ];
    }
}
