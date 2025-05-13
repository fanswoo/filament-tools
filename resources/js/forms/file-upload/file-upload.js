export default function fileUpload(state) {
  return {
    state,
    init() {
      this.$wire.$on('on-files-uploaded', (event) => {
        this.state.push(...event.files);
      });
      this.$wire.$on('on-file-deleted', (event) => {
        this.state = this.state.filter(file => file.id !== event.id);
      });
      this.$wire.$on('on-files-sorted', (event) => {
        const { item, position } = event;
        const currentIndex = this.state.indexOf(item);

        this.state.splice(currentIndex, 1);
        this.state.splice(position, 0, item);
      });
    },
  }
}