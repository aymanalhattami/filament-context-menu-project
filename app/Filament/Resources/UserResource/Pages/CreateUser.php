<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use AymanAlhattami\FilamentContextMenu\ContentMenu;
use AymanAlhattami\FilamentContextMenu\ContentMenuItem;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create')
                ->action('create')
                ->link(),
        ];
    }

    public function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                Action::make('List users')
                    ->translateLabel()
                    ->link()
                    ->color('gray')
                    ->url(ListUsers::getUrl())
                    ->icon('heroicon-o-users'),
            ]);
    }
}
