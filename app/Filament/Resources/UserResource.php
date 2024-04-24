<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use AymanAlhattami\FilamentContextMenu\Columns\ContextMenuTextColumn;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15),
                        Action::make('Change name')
                            ->form([
                                Forms\Components\TextInput::make('name')
                            ])
                            ->action(function ($data) use ($record) {
                                $record->update(['name' => $data['name']]);
                            })
                            ->icon('heroicon-o-plus')
                            ->link(),
                        ContextMenuDivider::make(),
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15)
                    ]),
                ContextMenuTextColumn::make('name')
                    ->searchable()
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15),
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15)
                    ])
                    ,
                ContextMenuTextColumn::make('email')
                    ->searchable()
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15),
                    ]),
                ContextMenuTextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15),
                    ]),
                ContextMenuTextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15),
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15)
                    ]),
                ContextMenuTextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15),
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15)
                    ]),
                ContextMenuTextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->contextMenuActions(fn (Model $record) => [
                        Action::make('test')
                            ->url(Pages\ViewUser::getUrl(['record' => $record]))
                            ->link()
                            ->icon('heroicon-o-user')
                            ->badge(15)
                    ])
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
