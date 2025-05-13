export default function uploadButton() {
  return {
    init() {
      this.$wire.el.querySelector('label').addEventListener('click', (event) => {
        event.preventDefault();
        this.$wire.el.querySelector('input[type="file"]').click();
      });
    },
    uploadedMessage: '',
    onFileUpload(event) {
      const files = this.$wire.el.querySelector('input[type="file"]').files;

      this.$wire.uploadMultiple('files', files, async () => {
        const result = await this.$wire.saveFiles();
        if (result.status) {
          this.uploadedMessage = '上傳成功';
          this.$wire.$dispatch('on-files-uploaded', { files: result.files });
        } else {
          this.uploadedMessage = result.message;
          this.$wire.$dispatch('on-files-uploaded', { uploadedMessage: this.uploadedMessage });
        }
        // empty files
        this.$wire.el.querySelector('input[type="file"]').value = '';
      }, (error) => {
        console.error(error);
        this.uploadedMessage = '上傳失敗';
        this.$wire.$dispatch('on-files-uploaded', { message: this.uploadedMessage });
      }, (event) => {
      }, () => {
        this.uploadedMessage = '上傳失敗';
        this.$wire.$dispatch('on-files-uploaded', { message: this.uploadedMessage });
        console.warn('upload cancelled');
      })
    },
  };
}