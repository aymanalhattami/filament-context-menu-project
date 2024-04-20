<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\CopyAction;
use AymanAlhattami\FilamentContextMenu\GoBackAction;
use AymanAlhattami\FilamentContextMenu\InteractsWithContextMenuActions;
use AymanAlhattami\FilamentContextMenu\RefreshAction;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    use InteractsWithContextMenuActions;

    protected static string $resource = UserResource::class;

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            RefreshAction::make(),
            CreateAction::make('Create user')
                ->label('Create user')
                ->translateLabel()
                ->model(User::class)
                ->icon('heroicon-o-user-plus')
                ->link()
                ->form([
                    \Filament\Forms\Components\Grid::make(2)
                        ->schema([
                            TextInput::make('name'),
                            TextInput::make('email'),
                            TextInput::make('password')->password(),
                        ])
                ]),
            CreateAction::make()
                ->label('Create user page')
                ->link()
                ->icon('heroicon-o-plus')
                ->color('gray')
                ->url(CreateUser::getUrl()),
        ];
    }
}
