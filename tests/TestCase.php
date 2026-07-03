<?php

declare(strict_types=1);

namespace Trustbird\Filament\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Trustbird\Filament\FilamentTrustbirdServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            FilamentTrustbirdServiceProvider::class,
        ];
    }
}
