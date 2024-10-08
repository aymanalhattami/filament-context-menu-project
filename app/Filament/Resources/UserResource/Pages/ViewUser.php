<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    use PageHasContextMenu;

    protected static string $resource = UserResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
            ContextMenuDivider::make(),
            Actions\EditAction::make('Edit modal')
                ->label(__('Edit user'))
                ->record($this->getRecord())
                ->form([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('email')->email(),
                        ])
                ])
                ->link()
                ->icon('heroicon-o-pencil'),
            Actions\EditAction::make()
                ->label(__('Edit user page'))
                ->color('gray')
                ->link()
                ->url(EditUser::getUrl(['record' => $this->getRecord()]))
                ->icon('heroicon-o-pencil-square'),
            Action::make('List users')
                ->label(__('List users'))
                ->translateLabel()
                ->link()
                ->color('gray')
                ->url(ListUsers::getUrl())
                ->icon('heroicon-o-users')
                ->badge(User::count()),
            Action::make('Edit name')
                ->label(__('Edit name'))
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
                        'name', 'email'
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
                ->model(User::class)
                ->label(__('Create user'))
                ->link()
                ->icon('heroicon-o-plus')
                ->form([
                    \Filament\Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('email'),
                            TextInput::make('password')->password(),
                        ])
                ]),
            Actions\CreateAction::make('Create user page')
                ->label(__('Create user page'))
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
