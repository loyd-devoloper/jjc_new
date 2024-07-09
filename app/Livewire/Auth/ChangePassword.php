<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class ChangePassword extends Component implements HasForms
{
    use InteractsWithForms;
    public $data = [];
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('password')
                    ->required()->password()->revealable()->confirmed()->minLength(8),
                TextInput::make('password_confirmation')
                    ->password()
                    ->required()->revealable()->minLength(8),
            ])
            ->statePath('data');
    }
    public function store()
    {
        User::where('id',Auth::guard('web')->id())->update([
            'password'=>Hash::make($this->data['password'])
        ]);
        Notification::make()
        ->title('Saved successfully')
        ->success()
        ->send();
    }
    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
