<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Form;
use Filament\Tables\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([

            TextInput::make('name')
                ->string()
                ->placeholder('Nome')
                ->required(),

            TextInput::make('phone')
                ->string()
                ->placeholder('Telefone')
                ->required(),

            TextInput::make('email')
                ->string()
                ->placeholder('Email')
                ->required(),

            TextInput::make('password')
                ->string()
                ->placeholder('Senha')
                ->required(),

            Toggle::make('status')
                ->onColor('success')
                ->offColor('danger')
                
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make(name: 'id'),
                TextColumn::make(name: 'name'),
                TextColumn::make(name: 'phone'),
                TextColumn::make(name: 'email'),
                //TextColumn::make(name: 'password'),
                TextColumn::make(name: 'status'),
                TextColumn::make(name: 'updated_at'),
            ])
            ->filters([
                //
            ])
            ->actions([

                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }

    protected function createRules()
    {
        return [
            'name' => 'required',
        ];
    }
}
