<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use AymanAlhattami\FilamentContextMenu\Actions\GoBackAction;
use AymanAlhattami\FilamentContextMenu\Actions\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\Actions\RefreshAction;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions\Action;

class Dashboard extends \Filament\Pages\Dashboard
{
    use PageHasContextMenu;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
            ContextMenuDivider::make(),
            Action::make('users')
                ->label('Users')
                ->translateLabel()
                ->url(ListUsers::getUrl())
                ->link()
                ->icon('heroicon-o-users')
                ->link()
                ->color('gray')
                ->badge(10),
            Action::make('Create user')
                ->label('Create user')
                ->translateLabel()
                ->url(CreateUser::getUrl())
                ->link()
                ->icon('heroicon-o-user-plus')
                ->link()
        ];
    }
}
