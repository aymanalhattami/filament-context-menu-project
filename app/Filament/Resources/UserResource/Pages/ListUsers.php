<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\CopyAction;
use AymanAlhattami\FilamentContextMenu\GoBackAction;
use AymanAlhattami\FilamentContextMenu\RefreshAction;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }



    public function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                GoBackAction::make(),
                RefreshAction::make(),
                Action::make('Create User')
                    ->translateLabel()
                    ->link()
                    ->color('gray')
                    ->url(CreateUser::getUrl())
                    ->icon('heroicon-o-user-plus'),
                CreateAction::make()
                    ->link()
                    ->icon('heroicon-o-plus')
                    ->color('gray')
                    ->url(CreateUser::getUrl()),
                CreateAction::make()
                    ->label('Quick create')
                    ->translateLabel()
                    ->icon('heroicon-o-user-plus')
                    ->color('gray')
                    ->link(),
            ]);
    }
}
