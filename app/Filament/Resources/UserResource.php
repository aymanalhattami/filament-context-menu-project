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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('View user')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user'),
                        Action::make('Edit user')
                            ->url(Pages\EditUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-pencil'),
                        ContextMenuDivider::make()->visible(false),
                    ])
                ,
                ContextMenuTextColumn::make('name')
                    ->searchable()
//                    ->contextMenuActions(fn (Model $record) => [
//                        Action::make('View user')
//                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-user'),
//                        Action::make('Edit user')
//                            ->url(Pages\EditUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-pencil'),
//                        ContextMenuDivider::make(),
//                        DeleteAction::make('test')
//                            ->record($record)
//                            ->link()
//                            ->icon('heroicon-o-trash')
//                    ])
                    ,
                ContextMenuTextColumn::make('email')
                    ->searchable()
//                    ->contextMenuActions(fn (Model $record) => [
//                        Action::make('View user')
//                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-user'),
//                        Action::make('Edit user')
//                            ->url(Pages\EditUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-pencil'),
//                        ContextMenuDivider::make(),
//                        DeleteAction::make('test')
//                            ->record($record)
//                            ->link()
//                            ->icon('heroicon-o-trash')
//                    ])
                ,
                ContextMenuTextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
//                    ->contextMenuActions(fn (Model $record) => [
//                        Action::make('View user')
//                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-user'),
//                        Action::make('Edit user')
//                            ->url(Pages\EditUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-pencil'),
//                        ContextMenuDivider::make(),
//                        DeleteAction::make('test')
//                            ->record($record)
//                            ->link()
//                            ->icon('heroicon-o-trash')
//                    ])
                ,
                ContextMenuTextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
//                    ->contextMenuActions(fn (Model $record) => [
//                        Action::make('View user')
//                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-user'),
//                        Action::make('Edit user')
//                            ->url(Pages\EditUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-pencil'),
//                        ContextMenuDivider::make(),
//                        DeleteAction::make('test')
//                            ->record($record)
//                            ->link()
//                            ->icon('heroicon-o-trash')
//                    ])
                ,
                ContextMenuTextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
//                    ->contextMenuActions(fn (Model $record) => [
//                        Action::make('View user')
//                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-user'),
//                        Action::make('Edit user')
//                            ->url(Pages\EditUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-pencil'),
//                        ContextMenuDivider::make(),
//                        DeleteAction::make('test')
//                            ->record($record)
//                            ->link()
//                            ->icon('heroicon-o-trash')
//                    ])
                ,
                ContextMenuTextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
//                    ->contextMenuActions(fn (Model $record) => [
//                        Action::make('View user')
//                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-user'),
//                        Action::make('Edit user')
//                            ->url(Pages\EditUser::getUrl(['record' => $record]))
//                            ->link()
//                            ->icon('heroicon-o-pencil'),
//                        ContextMenuDivider::make(),
//                        DeleteAction::make('test')
//                            ->record($record)
//                            ->link()
//                            ->icon('heroicon-o-trash')
//                    ])
                ,
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
            ])
            ;
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
}
