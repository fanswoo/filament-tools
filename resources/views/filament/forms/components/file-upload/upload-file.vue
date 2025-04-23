<template>
  <div>
    <UploadButton
      v-if="!hideUploadButton"
      :postMaxSize="postMaxSize"
      :uploadMaxSize="uploadMaxSize"
      :defaultMessage="defaultMessage"
      v-model="files"
      @onChangeFiles="onChangeFiles($event)"
    />
    <UploadList
      v-model="files"
      :inputName="inputName"
      @onChangeFiles="onChangeFiles($event)"
    />
  </div>
</template>

<script setup lang="ts">
import UploadButton from './upload-button.vue';
import UploadList from './upload-list.vue';

const props = defineProps({
  isSinglePic: {
    type: Boolean,
    default: false,
  },
  hideUploadButton: {
    type: Boolean,
    default: false,
  },
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
  fileDatas: {
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
const onChangeFiles = (value) => {
  files.value = value;
};
</script>
