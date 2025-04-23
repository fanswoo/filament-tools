@php
  $statePath = $getStatePath();
  $buttonText = $getButtonText();
  $files = $getFiles();
  $fileRelatedName = $getFileRelatedName();
  $isMultiple = $isMultiple();
@endphp

<x-dynamic-component
  :component="$getFieldWrapperView()"
  :field="$field"
>
  <div
    x-data="{
      state: $wire.$entangle('{{ $getStatePath() }}')
    }"
    @file-uploaded.window="state = $event.detail.files"
  >
    @livewire(\FF\FilamentTools\Forms\Components\FileUpload\UploadButton::class, [
      'buttonText' => $buttonText,
      'fileRelatedName' => $fileRelatedName,
      'isMultiple' => $isMultiple,
    ])
    @livewire(\FF\FilamentTools\Forms\Components\FileUpload\UploadList::class)
  </div>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('fileUpload', () => ({
      }));
    });
  </script>
</x-dynamic-component>
