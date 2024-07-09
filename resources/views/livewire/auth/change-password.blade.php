<div>
<form action="">
    {{ $this->form }}
   <div class="mt-3 flex justify-end ">
    <x-filament::button wire:click="store" color="danger">
        Change password
    </x-filament::button>
   </div>
</form>
</div>
