<?php

declare(strict_types=1);

namespace Trustbird\Filament\Pages;

use Filament\Pages\Page;

final class Dashboard extends Page
{
    protected string $view = 'filament-trustbird::pages.dashboard';

    protected static ?string $title = 'Trustbird';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';

    protected static ?int $navigationSort = 10;
}
