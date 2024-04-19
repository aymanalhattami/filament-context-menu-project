<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\ContentMenu;
use AymanAlhattami\FilamentContextMenu\ContentMenuDivider;
use AymanAlhattami\FilamentContextMenu\ContentMenuItem;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use Filament\Actions;
use Filament\Actions\Action;
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

    public function getContextMenu(): ContextMenu
    {
        return ContextMenu::make()
            ->actions([
                Action::make('List users')
                    ->translateLabel()
                    ->link()
                    ->color('gray')
                    ->url(ListUsers::getUrl())
                    ->icon('heroicon-o-users')
                    ->badge(User::count()),
                Action::make('Create user')
                    ->translateLabel()
                    ->link()
                    ->color('gray')
                    ->url(CreateUser::getUrl())
                    ->icon('heroicon-o-user-plus'),
                ContentMenuDivider::make(),
                Actions\DeleteAction::make()
                    ->record($this->getRecord())
                    ->translateLabel()
                    ->icon('heroicon-o-trash')
                    ->link(),
            ]);
    }
}
