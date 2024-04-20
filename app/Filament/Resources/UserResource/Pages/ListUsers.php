<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\ContextMenu;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use AymanAlhattami\FilamentContextMenu\CopyAction;
use AymanAlhattami\FilamentContextMenu\GoBackAction;
use AymanAlhattami\FilamentContextMenu\GoForwardAction;
use AymanAlhattami\FilamentContextMenu\InteractsWithContextMenuActions;
use AymanAlhattami\FilamentContextMenu\RefreshAction;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;

class ListUsers extends ListRecords
{
    use InteractsWithContextMenuActions;

    protected static string $resource = UserResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            Actions\ImportAction::make()
//                ->importer(UserImporter::class)
//                ->link()
//                ->icon('heroicon-o-arrow-up-tray')
//                ->visible(false),
//            Actions\ExportAction::make()
//                ->exporter(UserExporter::class)
//                ->link()
//                ->icon('heroicon-o-arrow-down-tray'),
//        ];
//    }

    public function getContextMenuActions(): array
    {
        return [
            GoBackAction::make(),
            GoForwardAction::make(),
            RefreshAction::make(),
            ContextMenuDivider::make(),
            Actions\ImportAction::make()
                ->importer(UserImporter::class)
                ->link()
                ->icon('heroicon-o-arrow-up-tray'),
            Actions\ExportAction::make()
                ->exporter(UserExporter::class)
                ->link()
                ->icon('heroicon-o-arrow-down-tray')
                ->formats([
                    ExportFormat::Csv,
                ]),
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
