<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\GoBackAction;
use AymanAlhattami\FilamentContextMenu\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\InteractsWithContextMenuActions;
use AymanAlhattami\FilamentContextMenu\RefreshAction;
use Filament\Actions\Action;
use Filament\Pages\Page;

class Dashboard extends \Filament\Pages\Dashboard
{
    use InteractsWithContextMenuActions;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
