<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use AymanAlhattami\FilamentContextMenu\ContentMenu;
use AymanAlhattami\FilamentContextMenu\ContentMenuItem;
use Filament\Actions;
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

    public static function getContextMenu(): ContentMenu
    {
        return ContentMenu::make()
            ->items([
                ContentMenuItem::make()
                    ->title('Create New user')
                    ->url('https://www.google.com')
                    ->target('_blank'),
            ]);
    }
}
