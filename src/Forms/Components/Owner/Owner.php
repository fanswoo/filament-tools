<?php

namespace FF\FilamentTools\Forms\Components\Owner;

use Filament\Forms\Components\Select;

class Owner extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->preload()
            ->required()
            ->default(fn() => auth()->id());
    }

    public function permissions(array $optionPermissions, array $managePermissions): static
    {
        return $this
            ->relationship(
                name: $this->name,
                titleAttribute: 'name',
                modifyQueryUsing: fn ($query) => $query->permission([
                    ...$optionPermissions,
                    ...$managePermissions,
                ])->orWhere('id', auth()->id())
            )
            ->disabled(fn ($operation) =>
                $operation === 'edit' &&
                !auth()->user()->canAny($managePermissions)
            );
    }
}