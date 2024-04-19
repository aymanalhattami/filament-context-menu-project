<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\GoBackAction;
use AymanAlhattami\FilamentContextMenu\RefreshAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                GoBackAction::make(),
                RefreshAction::make(),
                Action::make('List users')
                    ->translateLabel()
                    ->link()
                    ->color('gray')
                    ->url(ListUsers::getUrl())
                    ->icon('heroicon-o-users')
                    ->badge(User::count()),
            ]);
    }
}
