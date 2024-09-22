<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\Columns\ContextMenuTextColumn;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\{Builder, Model};
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getModelLabel(): string
    {
        return __('User');
    }

    public static function getNavigationLabel(): string
    {
        return __('Users');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->hiddenOn(['edit'])
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ContextMenuTextColumn::make('id')
                    ->searchable()
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
                ContextMenuTextColumn::make('name')
                    ->searchable()
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
                ContextMenuTextColumn::make('email')
                    ->searchable()
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
                ContextMenuTextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
                ContextMenuTextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
                ContextMenuTextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
                ContextMenuTextColumn::make('deleted_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->contextMenuActions(fn (User $record) => static::getTableContextMenu($record)),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}/view'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getTableContextMenu(Model $record): array
    {
        return [
            Action::make('View user')
                ->label(__('View user'))
                ->url(Pages\ViewUser::getUrl(['record' => $record->id]))
                ->link()
                ->color('gray')
                ->icon('heroicon-o-user'),
            Action::make('Edit user')
                ->label(__('Edit user'))
                ->url(Pages\EditUser::getUrl(['record' => $record->id]))
                ->link()
                ->color('gray')
                ->icon('heroicon-o-pencil'),
        ];
    }
}
