<?php

declare(strict_types=1);

namespace Trustbird\Filament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Trustbird\Filament\Pages\Dashboard;

final class TrustbirdPanelPlugin implements Plugin
{
    public function getId(): string
    {
        return 'trustbird';
    }

    public function register(Panel $panel): void
    {
        $panel->pages([
            Dashboard::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): self
    {
        return app(self::class);
    }
}
