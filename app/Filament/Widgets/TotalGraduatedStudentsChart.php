<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TotalGraduatedStudentsChart extends ChartWidget
{
  protected static ?string $heading = 'Graduated Students';

  protected function getData(): array
  {
    $currentYear = (int) date('Y');
    $totalGraduatedStudents = Student::query()
      ->select(
        'graduated_at',
        DB::raw('count(*) as total_students')
      )
      ->where('graduated_at', '>=', $currentYear - 4)
      ->groupBy('graduated_at')
      ->orderBy('graduated_at')
      ->get();

    return [
      'datasets' => [
        [
          'label' => 'Total students',
          'data' => $totalGraduatedStudents->pluck('total_students')->toArray(),
        ],
      ],
      'labels' => $totalGraduatedStudents->pluck('graduated_at')->toArray(),
    ];
  }

  protected function getType(): string
  {
    return 'line';
  }
}
