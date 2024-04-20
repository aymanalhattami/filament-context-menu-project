<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\InteractsWithContextMenuActions;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    use InteractsWithContextMenuActions;

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    public function getContextMenuActions(): array
    {
        return [
            Actions\Action::make("View")
                ->label('View user')
                ->record($this->getRecord())
                ->infolist([
                    Grid::make(2)
                        ->schema([
                            TextEntry::make('name'),
                            TextEntry::make('email'),
                            TextEntry::make('created_at'),
                            TextEntry::make('updated_at')
                        ])
                ])
                ->link()
                ->icon('heroicon-o-eye'),
            Actions\ViewAction::make()
                ->label('View user page')
                ->link()
                ->url(ViewUser::getUrl(['record' => $this->getRecord()]))
                ->icon('heroicon-o-eye'),
            Action::make('List users')
                ->translateLabel()
                ->link()
                ->color('gray')
                ->url(ListUsers::getUrl())
                ->icon('heroicon-o-users')
                ->badge(User::count()),
            Action::make('Edit name')
                ->label('Edit name')
                ->form([
                    \Filament\Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('name')->default($this->getRecord()->name),
                            TextInput::make('email')->default($this->getRecord()->email)
                        ])
                ])
                ->action(function($data){
                    $this->getRecord()->update([
                        'name' => $data['name'],
                        'email' => $data['email'],
                    ]);

                    $this->refreshFormData([
                        'name',  'email'
                    ]);

                    Notification::make()
                        ->success()
                        ->title('success')
                        ->send();
                })
                ->translateLabel()
                ->link()
                ->color('gray')
                ->icon('heroicon-o-pencil'),
            Actions\CreateAction::make()
                ->label('Create user')
                ->model(User::class)
                ->link()
                ->icon('heroicon-o-plus')
                ->form([
                    \Filament\Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('email'),
                            TextInput::make('password')->password(),
                        ])
                ])
            ,
            Action::make('Create user page')
                ->translateLabel()
                ->link()
                ->color('gray')
                ->url(CreateUser::getUrl())
                ->icon('heroicon-o-user-plus'),
            ContextMenuDivider::make(),
            Actions\DeleteAction::make()
                ->record($this->getRecord())
                ->translateLabel()
                ->icon('heroicon-o-trash')
                ->link(),
        ];
    }
}
