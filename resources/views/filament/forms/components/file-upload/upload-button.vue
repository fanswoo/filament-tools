<template>
  <div>
    <div class="file-upload-button">
      <span><font-awesome-icon icon="file" /> 上傳檔案</span>
      <input
        name="files[]"
        type="file"
        multiple
        @change="onUploadFiles($event)"
      />
    </div>
    <span class="file-upload-message" v-html="message"></span>
  </div>
</template>

<script lang="ts" setup>
import { onMounted, ref } from 'vue';

const { defaultMessage, postMaxSize, uploadMaxSize } = defineProps({
  postMaxSize: {
    type: Number,
    default: 0,
  },
  uploadMaxSize: {
    type: Number,
    default: 0,
  },
  defaultMessage: {
    type: String,
    default: '點選 <kbd>CTRL</kbd> 可複選檔案',
  },
});

const files = defineModel();

const emit = defineEmits(['onChangeFiles']);

const message = ref(defaultMessage);

onMounted(() => {
  // message.value = defaultMessage;
});

const onUploadFiles = async (event): Promise<boolean> => {
  let sizeTotal = 0;
  for (let i = 0; i < event.target.files.length; i += 1) {
    sizeTotal += event.target.files[i].size;
  }
  if (
    (postMaxSize > 0 && sizeTotal > postMaxSize) ||
    (uploadMaxSize > 0 && sizeTotal > uploadMaxSize)
  ) {
    message.value = defaultMessage;
    alert(`最大同時上傳限制超過 ${postMaxSize / 1024 / 1024}M`);
    return false;
  }

  const params = new FormData();
  for (let i = 0; i < event.target.files.length; i += 1) {
    params.append('files[]', event.target.files[i]);
  }
  params.append('_token', <any>$('meta[name="csrf-token"]').attr('content'));

  message.value = '檔案上傳中...';

  let response;
  try {
    response = await axios.post(
      window.location.origin + '/api/file/upload',
      params,
      {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      },
    );
  } catch (error) {
    console.error(error);
    message.value = '檔案格式錯誤';
    return false;
  }

  if (response.data.status === true) {
    files.value.push(...response.data.files);
  }

  if (response.data.status === true && files.value) {
    for (let fileIndex = 0; fileIndex < files.value.length; fileIndex += 1) {
      const file = {
        id: files.value[fileIndex].id,
        title: files.value[fileIndex].title,
        downloadUrl: files.value[fileIndex].downloadUrl,
      };
    }
  }

  message.value = defaultMessage;
  return true;
};
</script>

<style lang="scss" scoped>
$color-blue: rgba(14, 165, 233);
$color-white: rgba(226, 232, 240);

.file-upload-button {
  position: relative;
  overflow: hidden;
  margin: 5px 5px 5px 0;
  display: inline-block;
  padding: 0;
  color: $color-white;
  text-align: center;
  vertical-align: middle;
  background: $color-blue;
  font-weight: 700;
  border-radius: 4px;
  cursor: pointer;
  & > span {
    display: block;
    border-radius: 4px;
    padding: 0 10px;
    height: 28px;
    line-height: 30px;
    cursor: pointer;
    font-size: 12px;
  }
  input {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    border: solid transparent;
    opacity: 0;
    filter: alpha(opacity=0);
    cursor: pointer;
    animation: none;
    transition: none;
    line-height: 30px;
    height: 30px;
  }
  .file-upload-message {
    color: #777;
    height: 20px;
    line-height: 20px;
  }
}
</style>
