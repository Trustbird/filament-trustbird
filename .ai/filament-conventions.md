# Filament Conventions for `trustbird/filament-trustbird`

## Filament version

Use Filament v4 conventions only.

Do not add Filament v3 patterns, deprecated APIs or compatibility layers unless explicitly required and documented.

## Plugin registration

The package should integrate through a Filament plugin.

Primary entry point:

```php
use Trustbird\Filament\TrustbirdPanelPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(TrustbirdPanelPlugin::make());
}
```

The plugin should be responsible for registering Trustbird pages, resources and widgets with the host panel.

Do not assume that Trustbird owns the entire Filament panel. This package must work inside an existing application panel.

## Panel assumptions

Do not assume:

* the panel path;
* the panel ID;
* the auth guard;
* the user model;
* the tenant model;
* the theme;
* the navigation structure;
* the app locale;
* that Trustbird is the only package installed.

Always prefer host-app configurability.

## Resources

Filament resources should be thin adapters around core models and actions.

A resource may define:

* navigation metadata
* labels
* forms
* tables
* infolists
* relation managers
* Filament actions
* visibility hooks

A resource may not define:

* domain workflows
* framework mapping rules
* risk scoring algorithms
* evidence acceptance rules
* policy approval rules
* compliance status calculations

Those must come from `trustbird/laravel-trustbird`.

## Forms

Form schemas should be clear, short and progressively disclosed.

Use:

* sections for grouping
* helper text for plain-language explanation
* placeholders where they reduce confusion
* sensible defaults from the core
* enum/options from the core where available
* validation rules from the core where available

Avoid:

* long compliance-heavy forms
* repeating the same field groups across resources without extraction
* hard-coded option lists that duplicate core enums
* making framework references required too early

Example principle:

```php
Select::make('owner_id')
    ->label('Owner')
    ->helperText('The person responsible for keeping this item up to date.');
```

## Tables

Tables should help users decide what needs attention.

Prefer columns such as:

* name
* owner
* status
* next review date
* evidence status
* updated at

Avoid tables that are only database dumps.

Every table should answer:

* What is this?
* Who owns it?
* What needs to happen next?
* Is it still current?
* Is there evidence?

## Actions

Filament actions may collect input and call the core.

Actions should be named after user intent:

```text
Request evidence
Mark ready for review
Start review
Archive
Assign owner
```

Avoid technical or framework-first labels:

```text
Set control status
Run compliance mutation
Update framework node
```

Actions that change important state should:

* call a core action/service;
* show a confirmation when the change is significant;
* create or rely on a core audit log where applicable;
* avoid silent destructive behavior.

## Pages

Pages should be used for workflows that are not naturally CRUD.

Good page candidates:

* Trustbird dashboard
* setup assistant
* company context wizard
* evidence inbox
* review center
* framework readiness overview
* package/license status
* AI suggestion review

Pages should not become service objects. Keep workflow decisions in the core.

## Widgets

Widgets should summarize useful next steps, not create a panic dashboard.

Good widgets:

* items needing review
* evidence requests due soon
* open measures
* recently approved policies
* setup progress
* suggested next actions

Avoid:

* red-heavy compliance scoreboards
* unexplained percentages
* framework status claims without evidence context
* vanity metrics

## Views

Blade views must remain simple.

Use Blade for rendering, not for business decisions.

Bad:

```blade
@if ($record->score >= 12 && $record->impact === 'high')
    High risk
@endif
```

Good:

```blade
{{ $record->display_status }}
```

or pass a view model/presenter from a UI-only class when appropriate.

## Configuration

Package configuration should be limited to Filament integration behavior.

Good configuration examples:

```php
return [
    'navigation_group' => 'Trustbird',
    'navigation_sort' => 10,
    'register_dashboard_page' => true,
    'register_resources' => true,
];
```

Bad configuration examples:

```php
return [
    'risk_score_threshold' => 12,
    'iso_control_status_rules' => [],
    'gdpr_article_mappings' => [],
];
```

Domain configuration belongs in the core or package/content system.

## Authorization and visibility

Respect host application authorization.

When possible:

* use policies from the core or host app;
* keep Filament visibility checks simple;
* avoid inventing new permission names unless the core exposes them;
* do not bypass authorization for convenience.

## Translations

User-facing strings should be prepared for translation.

Avoid scattering repeated hard-coded labels across classes.

Prefer:

* translation files for stable copy;
* enums/value objects from the core for status labels;
* clear English defaults;
* Dutch support when the surrounding package is ready for it.

## Accessibility

Filament components should remain accessible.

Use:

* descriptive labels
* helper text
* meaningful action names
* clear validation messages
* visible focus behavior through Filament defaults

Do not rely only on color to communicate status.

## Test examples

Test plugin registration:

```php
it('registers the Trustbird dashboard page', function (): void {
    $plugin = TrustbirdPanelPlugin::make();

    expect($plugin->getId())->toBe('trustbird');
});
```

Test that UI actions call the core instead of duplicating logic.

Test that pages/resources are registered through the plugin.

Test that important form/table behavior works in a Testbench application.

## Pull request checklist

Before opening or merging a PR:

* The change is UI-only.
* Any required core change is already available in `trustbird/laravel-trustbird`.
* Filament v4 APIs are used.
* No migrations were added.
* No domain models were added.
* No domain actions/services were added.
* No compliance claims were hard-coded.
* Empty states and labels use plain language.
* Tests cover the behavior.
* Formatting, tests, coverage and static analysis pass.
