<div x-data="uploadList">
  <div x-sort="onSortFiles" class="grid gap-2">
    <template x-for="(file, index) in state" :key="index">
      <div
        x-sort:item="index"
       class="flex gap-1 rounded-lg p-2 ring-1 shadow-sm transition bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20 cursor-move"
      >
        <span
          x-text="file.title"
        ></span>
        <a :href="file.downloadUrl" title="下載" class="w-6 h-6">
          <x-heroicon-m-cloud-arrow-down />
        </a>
        <span
          title="刪除"
          class="w-6 h-6 cursor-pointer"
        >
        <x-heroicon-s-x-circle
          @click="onFileDeleted(file.id)"
        /></span>
      </div>
    </template>
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('uploadList', () => ({
      onFileDeleted(id) {
        this.$wire.$dispatch('on-file-deleted', { id });
      },
      onSortFiles(item, position) {
        console.log(this);
        this.$wire.$dispatch('on-files-changed', { item, position });
      }
    }));
  });
</script>