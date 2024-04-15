<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Helper\ContentMenu;
use App\Helper\ContentMenuItem;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

//    protected static string $view = 'filament.resources.user-resource.pages.list-users';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public static function getContextMenu(): ContentMenu
    {
        return ContentMenu::make()
            ->items([
                ContentMenuItem::make()
                    ->title('Create New user'),
            ]);
    }
}
