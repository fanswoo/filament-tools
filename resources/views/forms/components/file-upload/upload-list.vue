<template>
  <div class="ff-file-upload-list">
    <Draggable
      :handle="'.ff-upload-li'"
      :filter="'.ff-title'"
      v-model="files"
      @sort="onSortFies"
    >
      <template v-for="(file, index) in files" :key="index">
        <div class="ff-upload-li">
          <span class="ff-title" @click="onChangeFileName(file, $event)">
            {{ file.title }}
          </span>
          <a ref="downloadIcon" :href="file.downloadUrl" class="ff-file-icon" title="下載">
            <font-awesome-icon icon="download" />
          </a>
          <span
            ref="deleteIcon"
            class="ff-file-icon"
            @click="onFileDelete(file.id)"
            title="刪除"
          >
            <font-awesome-icon icon="trash" />
          </span>
          <input type="hidden" :name="inputName + '[]'" :value="file.id" />
        </div>
      </template>
    </Draggable>
  </div>
</template>

<script setup lang="ts">
import { VueDraggableNext as Draggable } from 'vue-draggable-next';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
  inputName: {
    type: String,
    default: '',
  },
  postMaxSize: {
    type: Number,
    default: 0,
  },
  uploadMaxSize: {
    type: Number,
    default: 0,
  },
  files: {
    type: Array,
    default() {
      return [];
    },
  },
  defaultMessage: {
    type: String,
    default: '點選 <kbd>CTRL</kbd> 可複選檔案',
  },
});

const files = defineModel();
const message = ref('');
const emit = defineEmits(['onChangeFiles']);

const onSortFies = (event) => {

  const tmp = files.value[event.oldIndex];
  files.value[event.oldIndex] = files.value[event.newIndex];
  files.value[event.newIndex] = tmp;
  emit('onChangeFiles', files.value);
};

const onFileDelete = (id) => {
  if (!window.confirm('確定要刪除檔案嗎？')) {
    return false;
  }

  files.value.forEach((fileData, index) => {
    if (fileData.id === id) {
      files.value.splice(index, 1);
      return true;
    }
    return false;
  });
  emit('onChangeFiles', files.value);
  return true;
};

const onChangeFileName = async (file, event) => {
  let promptMessage = '';
  promptMessage = prompt('請輸入想要變更的檔案名稱', file.title);

  if (promptMessage) {
    let response;
    try {
      response = await axios.post(
        `${$('base').attr('href')}api/file/rename`,
        {
          id: file.id,
          title: promptMessage,
        },
      );
    } catch (error) {
      console.warn(error);
    }

    const { data } = response;
    if (data.status === true) {
      files.value.forEach((fileData, index) => {
        if (fileData.id === file.id) {
          files.value[index].title = promptMessage;
          return true;
        }
        return false;
      });
      emit('onChangeFiles', files.value);
    }
  }
};
</script>

<style lang="scss" scoped>
$color-blue: #027de5;

.ff-file-upload-list {
  overflow: hidden;
  .ff-upload-li {
    float: left;
    line-height: 20px;
    margin: 0 5px 5px 0;
    padding: 5px 5px 5px 10px;
    overflow: hidden;
    border: 1px solid #ccc;
    background: #f5f5f5;
    border-radius: 5px;
    cursor: move;
    .ff-title {
      font-size: 12px;
      cursor: pointer;
      margin-right: 10px;
    }
    .ff-file-icon {
      color: #666;
      font-size: 12px;
      display: inline-block;
      line-height: 17px;
      margin-right: 5px;
      cursor: pointer;
      svg {
        width: 12px;
        height: 12px;
      }
    }
  }
}
</style>
