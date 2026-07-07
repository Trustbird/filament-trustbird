# AI Development Instructions for `trustbird/filament-trustbird`

This repository contains the optional Filament admin panel for Trustbird.

Its sole responsibility is to expose the Trustbird Laravel core through a clean, developer-friendly Filament interface. It must never become the domain layer itself.

## Repository role

`trustbird/filament-trustbird` is responsible for:

* Filament panel registration
* Filament resources
* Filament pages
* Filament widgets
* Filament forms
* Filament tables
* Filament actions
* Filament navigation
* Filament views
* Filament-specific configuration
* Filament-specific tests

`trustbird/filament-trustbird` is **not** responsible for:

* domain models
* database migrations
* business actions
* domain services
* contracts
* events
* policies
* authorization rules
* API endpoints
* framework mappings
* package marketplace logic
* evidence, risk, policy or measure domain rules

Those concerns belong in `trustbird/laravel-trustbird`.

## Golden rule

Never solve a domain problem inside the Filament package.

If a feature requires new business behavior, implement that behavior in `trustbird/laravel-trustbird` first. This package should only consume the public API exposed by the core package.

## Development workflow

When implementing new functionality, follow this order:

1. Verify whether the required capability already exists in `trustbird/laravel-trustbird`.
2. If it does not exist, stop and implement (or propose) the required core functionality first.
3. Build the smallest possible Filament UI around that capability.
4. Add or update tests.
5. Run formatting, static analysis and the full test suite before considering the work complete.

## Required commands

Every completed change should pass:

```bash
composer format
composer test
composer test:coverage
composer test:types
```

The project maintains a strict **100% test coverage** policy.

## Architecture boundary checklist

Before adding a new class, ask yourself:

* Is this purely a Filament concern?
* Can this class disappear without breaking the Laravel core package?
* Does it reuse existing domain services instead of duplicating logic?
* Does it avoid embedding business rules?
* Does it keep Trustbird's UI calm, understandable and business-oriented?

If the answer to any question is **no**, the change probably belongs in `trustbird/laravel-trustbird`.

## Design principles

Trustbird should feel calm, clear and practical.

Prefer:

* plain language
* progressive disclosure
* helpful empty states
* clear ownership
* actionable next steps

Avoid:

* compliance jargon
* auditor-first interfaces
* alarming dashboards
* duplicated framework terminology
* AI output presented as final truth

## AI behavior

When working in this repository, AI assistants must:

* preserve the strict separation between UI and domain logic;
* keep the Filament package optional;
* use Filament v4 conventions only;
* prefer small, testable changes;
* avoid unnecessary dependencies;
* never duplicate business logic from the core package;
* never introduce compliance decisions into the UI layer;
* never present AI-generated content as automatically approved or compliant.

## Related documentation

Additional repository-specific guidance is available in:

* `.ai/guidelines.md`
* `.ai/filament-conventions.md`

These documents complement this file and should be considered part of the development guidelines.
