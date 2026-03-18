export default function uploadList() {
  return {
    init() {
      self = this;
    },
    self: null,
    onFileDeleted(id) {
      this.$wire.$dispatch('on-file-deleted', { id });
    },
    onSortFiles(item, position) {
      self.$wire.$dispatch('on-files-sorted', { item, position });
    }
  };
}