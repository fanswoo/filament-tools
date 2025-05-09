<div
  x-data="uploadButton" class="mb-2"
>
  <label
    x-text="'{{ $buttonText }}'"
    style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
    class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action cursor-pointer"
  >
  </label>
  <input
    type="file"
    x-bind:multiple="{{ $this->isMultiple }}"
    @change="onFileUpload"
    class="hidden"
    accept="{{ $this->getAllowType() }}"
  />
  <template x-if="uploadedMessage">
    <span x-text="uploadedMessage" class="text-sm text-gray-500"></span>
  </template>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('uploadButton', () => ({
      init() {
        this.$wire.el.querySelector('label').addEventListener('click', (event) => {
          event.preventDefault();
          this.$wire.el.querySelector('input[type="file"]').click();
        });
      },
      uploadedMessage: '',
      onFileUpload(event) {
        const files = this.$wire.el.querySelector('input[type="file"]').files;

        this.$wire.uploadMultiple('files', files, async() => {
          const result = await this.$wire.saveFiles();
          if (result.status) {
            this.uploadedMessage = '上傳成功';
            this.$wire.$dispatch('on-file-uploaded', { files: result.files });
          } else {
            this.uploadedMessage = result.message;
            this.$wire.$dispatch('on-file-uploaded', { uploadedMessage: this.uploadedMessage });
          }
          // empty files
          this.$wire.el.querySelector('input[type="file"]').value = '';
        }, (error) => {
          console.error(error);
          this.uploadedMessage = '上傳失敗';
          this.$wire.$dispatch('on-file-uploaded', { message: this.uploadedMessage });
        }, (event) => {
        }, () => {
          this.uploadedMessage = '上傳失敗';
          this.$wire.$dispatch('on-file-uploaded', { message: this.uploadedMessage });
          console.warn('upload cancelled');
        })
      },
    }));
  });
</script>
