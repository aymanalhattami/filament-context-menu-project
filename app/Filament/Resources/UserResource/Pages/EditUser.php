<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\GoBackAction;
use AymanAlhattami\FilamentContextMenu\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\InteractsWithContextMenuActions;
use AymanAlhattami\FilamentContextMenu\RefreshAction;
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

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
            ContextMenuDivider::make(),
            Actions\ViewAction::make("View user with infolist")
                ->label('View user with infolist')
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
            Actions\ViewAction::make("View user with form")
                ->label('View user with form')
                ->record($this->getRecord())
                ->form([
                    \Filament\Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('email'),
                            TextInput::make('created_at'),
                            TextInput::make('updated_at')
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
                ->link()
                ->visible(function(){
                    return (bool) !$this->getRecord()->trashed();
                }),
            Actions\ForceDeleteAction::make()
                ->record($this->getRecord())
                ->translateLabel()
                ->icon('heroicon-o-trash')
                ->link()
                ->visible(function(){
                    return (bool) $this->getRecord()->trashed();
                })
                ->successRedirectUrl(ListUsers::getUrl()),
            Actions\RestoreAction::make()
                ->record($this->getRecord())
                ->translateLabel()
                ->icon('heroicon-o-arrow-uturn-left')
                ->link()
                ->visible(function(){
                    return (bool) $this->getRecord()->trashed();
                })
        ];
    }
}
