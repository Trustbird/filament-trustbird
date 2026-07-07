# General Guidelines for `trustbird/filament-trustbird`

## Purpose

This repository provides the optional Filament interface for Trustbird.

The Laravel core must remain usable without Filament. Developers should be able to install `trustbird/laravel-trustbird` and build their own UI without depending on this package.

That means this repository must stay thin, optional and UI-focused.

## Non-negotiables

### 1. Filament only

Only add code that belongs to the Filament integration layer.

Allowed examples:

```text
Trustbird\Filament\TrustbirdPanelPlugin
Trustbird\Filament\Resources\*
Trustbird\Filament\Pages\*
Trustbird\Filament\Widgets\*
Trustbird\Filament\Actions\*
Trustbird\Filament\Forms\*
Trustbird\Filament\Tables\*
```

Not allowed examples:

```text
Trustbird\Models\*
Trustbird\Actions\*
Trustbird\Contracts\*
Trustbird\Events\*
Trustbird\Policies\*
Trustbird\Services\*
Trustbird\Database\*
```

If those are needed, they belong in `trustbird/laravel-trustbird`.

### 2. No domain logic in UI classes

Filament resources, pages, widgets and actions may orchestrate UI flows, but they may not own business decisions.

Bad:

```php
if ($riskScore >= 12) {
    $record->status = 'high';
}
```

Good:

```php
app(UpdateRiskAssessment::class)->handle($record, $data);
```

Even better when the core exposes a fluent API:

```php
trustbird()->risks()->assess($record, $data);
```

### 3. No migrations

This package must not publish or run database migrations for Trustbird domain entities.

If a Filament-only setting is ever needed, prefer configuration first. If persistence is truly required, discuss whether it belongs in the core package.

### 4. No duplicated models

Never create local Eloquent models that mirror core models.

Use models from `trustbird/laravel-trustbird`.

### 5. No policy duplication

Authorization must come from the core package or host application.

Filament classes may reference permissions and policies, but they may not define new business authorization rules that conflict with the core.

### 6. No hard-coded framework content

Do not hard-code ISO 27001, GDPR, NIS2, SOC 2, DORA or other framework rules inside Filament resources.

Frameworks are data and mappings in the core/package ecosystem. The Filament package only displays and edits what the core exposes.

### 7. Human approval for AI output

AI-generated content must always be presented as a suggestion.

AI may help draft, summarize, classify or map. AI may not silently publish policies, close risks, approve evidence or mark framework status as complete.

## Coding standards

Use:

* PHP 8.4 syntax where appropriate
* `declare(strict_types=1);`
* final classes by default
* explicit return types
* constructor promotion where useful
* Laravel and Filament v4 conventions
* Pest for tests
* PHPStan-compatible code
* Laravel Pint formatting

Avoid:

* dynamic magic where explicit code is clearer
* large inheritance chains
* hidden side effects in Filament lifecycle hooks
* unrelated refactors
* new dependencies without a strong reason

## Namespace conventions

Use the package namespace:

```php
namespace Trustbird\Filament;
```

Suggested structure:

```text
src/
  TrustbirdPanelPlugin.php
  FilamentTrustbirdServiceProvider.php
  Resources/
  Pages/
  Widgets/
  Actions/
  Forms/
  Tables/
  Support/
resources/
  views/
tests/
```

`Support/` may contain small UI-only helpers. It must not contain domain services.

## Dependency policy

This package should have very few dependencies.

Allowed dependency categories:

* Filament
* Laravel package tooling
* testing/static-analysis tools
* `trustbird/laravel-trustbird`

Avoid adding UI libraries, helper packages or domain packages unless the benefit is clear and long-term.

## Testing policy

Every meaningful change needs tests.

Required coverage:

```text
100%
```

Test at least:

* plugin registration
* page/resource/widget registration
* form schema behavior
* table behavior
* Filament actions
* visibility rules
* empty states where relevant
* calls to core actions/services
* permission-sensitive UI behavior where applicable

Avoid tests that only assert implementation details.

Prefer testing behavior from the perspective of the Filament panel.

## UI language

Trustbird uses plain, calm language.

Use labels like:

```text
Needs review
Needs evidence
Ready for review
Draft
Approved
Archived
```

Avoid labels like:

```text
Failed
Non-compliant
Control violation
Audit failure
Certified
Compliant
Legally approved
```

## Empty states

Every important empty state should help the user understand:

1. what this screen is for;
2. why it matters;
3. what the next useful action is.

Bad:

```text
No records found.
```

Good:

```text
No policies yet. Start by creating the first agreement your team wants to keep up to date.
```

## Navigation principles

Keep navigation business-friendly.

Prefer:

```text
Policies
Risks
Measures
Evidence
Reviews
Suppliers
Settings
```

Avoid making the primary navigation framework-first:

```text
ISO 27001
Annex A
GDPR Articles
NIS2 Requirements
SOC 2 Criteria
```

Framework-specific views may exist, but they should not dominate the main product experience.

## Completion checklist

A change is only complete when:

* the code belongs in this package;
* domain boundaries are respected;
* UI copy is clear and calm;
* tests are added or updated;
* `composer format` passes;
* `composer test` passes;
* `composer test:coverage` passes;
* `composer test:types` passes;
* README or docs are updated when behavior changes.
