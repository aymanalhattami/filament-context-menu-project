<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use AymanAlhattami\FilamentContextMenu\ContentMenu;
use AymanAlhattami\FilamentContextMenu\ContentMenuItem;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public static function getContextMenu(): ContentMenu
    {
        return ContentMenu::make()
            ->items([
                ContentMenuItem::make()
                    ->title('Go back')
                    ->url(ListUsers::getUrl())
                    ->target('_blank'),
                ContentMenuItem::make()
                    ->title('Create New user')
                    ->url(CreateUser::getUrl())
            ]);
    }
}
