<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
  protected function getStats(): array
  {
    return [
      Stat::make('Total Students', Student::count()),
    ];
  }
}
