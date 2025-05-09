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
    x-data="fileUpload($wire.$entangle('{{ $getStatePath() }}'))"
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
      Alpine.data('fileUpload', (state) => ({
        state,
        init() {
          this.$wire.$on('on-file-uploaded', (event) => {
            this.state.push(...event.files);
          });
          this.$wire.$on('on-file-deleted', (event) => {
            this.state = this.state.filter(file => file.id !== event.id);
          });
          this.$wire.$on('on-files-changed', (event) => {
            const { item, position } = event;
            console.log(event);
            const file = this.state[item];
            this.state.splice(item, 1);
            this.state.splice(position, 0, file);
          });
        },
      }));
    });
  </script>
</x-dynamic-component>
