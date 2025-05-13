@inject('filamentAsset', Filament\Support\Facades\FilamentAsset::class )

<div
  x-load
  x-load-src="{{
    $filamentAsset::getAlpineComponentSrc(
      'upload-list',
      'fanswoo/filament-tools/forms/file-upload'
    )
  }}"
  x-data="uploadList"
>
  <div x-sort="onSortFiles" class="grid md:grid-cols-2 gap-2">
    <template x-for="(file, index) in state" :key="file.id + '-' + index">
      <div
        x-sort:item="file"
       class="flex gap-1 rounded-lg p-2 ring-1 shadow-sm bg-white dark:bg-white/5 ring-gray-950/10 dark:ring-white/20 cursor-move"
      >
        <span
          x-text="file.title"
          class="overflow-hidden whitespace-nowrap"
        ></span>
        <a :href="file.downloadUrl" title="下載" class="flex-none w-6 h-6">
          <x-heroicon-m-cloud-arrow-down />
        </a>
        <span
          title="刪除"
          class="flex-none w-6 h-6 cursor-pointer"
        >
        <x-heroicon-s-x-circle
          @click="onFileDeleted(file.id)"
        /></span>
      </div>
    </template>
  </div>
</div>