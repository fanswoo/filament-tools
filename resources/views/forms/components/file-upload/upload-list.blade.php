<div>
  <div class="ff-file-upload-list" x-sort>
    <template x-for="(file, index) in state" :key="index">
      <div x-sort:item>
        <span class="ff-title" x-text="file.title" @click="onChangeFileName(file, $event)"></span>
        <a ref="downloadIcon" :href="file.downloadUrl" class="ff-file-icon" title="下載">
          <font-awesome-icon icon="download"/>
        </a>
        <span
          ref="deleteIcon"
          class="ff-file-icon"
          @click="onFileDelete(file.id)"
          title="刪除"
        >
          <font-awesome-icon icon="trash"/>
        </span>
      </div>
    </template>
  </div>
</div>
