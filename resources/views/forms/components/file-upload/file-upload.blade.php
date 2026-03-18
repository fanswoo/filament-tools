@php
  $statePath = $getStatePath();
  $buttonText = $getButtonText();
  $files = $getFiles();
  $fileRelatedName = $getFileRelatedName();
  $isMultiple = $isMultiple();
@endphp

@inject('filamentAsset', Filament\Support\Facades\FilamentAsset::class )

<x-dynamic-component
  :component="$getFieldWrapperView()"
  :field="$field"
>
  <div
    x-load
    x-load-src="{{
      $filamentAsset::getAlpineComponentSrc(
        'file-upload',
        'fanswoo/filament-tools/forms/file-upload'
      )
    }}"
    x-data="fileUpload($wire.$entangle('{{ $getStatePath() }}'))"
  >
    @livewire(\FF\FilamentTools\Forms\Components\FileUpload\UploadButton::class, [
      'buttonText' => $buttonText,
      'fileRelatedName' => $fileRelatedName,
      'isMultiple' => $isMultiple,
    ])
    @livewire(\FF\FilamentTools\Forms\Components\FileUpload\UploadList::class)
  </div>
</x-dynamic-component>