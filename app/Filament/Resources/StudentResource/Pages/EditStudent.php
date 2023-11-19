<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\Student;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditStudent extends EditRecord
{
  protected static string $resource = StudentResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\DeleteAction::make()
        ->after(function (Student $student) {
          if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
          }
        }),
    ];
  }
}
