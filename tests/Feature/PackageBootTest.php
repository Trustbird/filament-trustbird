<?php

declare(strict_types=1);

use Trustbird\Filament\FilamentTrustbirdServiceProvider;
use Trustbird\Filament\TrustbirdPanelPlugin;

it('registers the service provider', function (): void {
    expect(app()->getProvider(FilamentTrustbirdServiceProvider::class))
        ->not()
        ->toBeNull();
});

it('has a stable plugin id', function (): void {
    expect(TrustbirdPanelPlugin::make()->getId())->toBe('trustbird');
});
