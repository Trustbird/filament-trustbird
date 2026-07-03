# Contributing

Thanks for considering a contribution to Filament Trustbird.

This package is the optional Filament UI layer for Trustbird. Keep all domain behavior in `trustbird/laravel-trustbird`.

## Development principles

- Keep this package UI-only.
- Do not add domain models, migrations or business rules here.
- Prefer explicit, IDE-friendly APIs.
- Add tests for every change.
- Keep test coverage at 100%.
- Use Laravel Pint before opening a pull request.

## Local setup

```bash
composer install
composer test
composer format
```

## Pull requests

Please keep pull requests small and focused. Include a clear description of the change and why it belongs in the Filament package rather than the core package.
