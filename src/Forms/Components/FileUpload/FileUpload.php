<?php

namespace FF\FilamentTools\Forms\Components\FileUpload;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Field;
use Illuminate\Support\HtmlString;

class FileUpload extends Field
{
    protected string $view = 'ff-filament-tools::forms.components.file-upload.file-upload';

    public string $buttonText = '上傳檔案';

    public bool $multiple = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->helperText(new HtmlString('點選 <kbd>CTRL</kbd> 可複選檔案'));

        $this->afterStateHydrated(static function ( $component, $state): void {
            $component->state($component->getFiles());
        });

        $this->dehydrateStateUsing(static function ($component, ?array $state) {
            $fileIds = [];
            foreach($state as $file) {
                if (is_array($file)) {
                    $fileIds[] = $file['id'];
                }
            }
            $component->getRecord()->{$component->name}('set', $fileIds);
        });

    }

    public function buttonText(string $value): static
    {
        $this->buttonText = $value;
        return $this;
    }

    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    public function multiple(bool $value = true): static
    {
        $this->multiple = $value;
        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    protected function getFileRelation()
    {
        return $this->getRecord()->{$this->name}();
    }

    public function getFileRelatedName()
    {
        return $this->getFileRelation()->getRelated()::class;
    }

    public function getFiles()
    {
        return $this->getRecord()->{$this->name} ?? [];
    }
}
