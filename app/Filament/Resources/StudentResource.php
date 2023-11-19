<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentResource extends Resource
{
  protected static ?string $model = Student::class;

  protected static ?string $navigationIcon = 'heroicon-o-user';

  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make()->schema([
          TextInput::make('nim')
            ->label('NIM')
            ->validationAttribute('NIM')
            ->required(),
          TextInput::make('name')->label('Nama')->required(),
          Radio::make('gender')->label('Jenis Kelamin')
            ->options([
              'male' => 'Laki-laki',
              'female' => 'Perempuan',
            ])
            ->default('male')
            ->required(),
          FileUpload::make('photo')
            ->image()
            ->imageCropAspectRatio('1:1')
            ->imageEditor()
            ->imageEditorAspectRatios(['1:1']),
        ])->columns(2),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('nim')->label('NIM'),
        TextColumn::make('name')->label('Nama'),
        TextColumn::make('gender')->label('Jenis Kelamin')
          ->formatStateUsing(
            fn (string $state): string => $state === 'male' ? 'Laki-laki' : 'Perempuan'
          ),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
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
      'index' => Pages\ListStudents::route('/'),
      'create' => Pages\CreateStudent::route('/create'),
      'edit' => Pages\EditStudent::route('/{record}/edit'),
    ];
  }
}
