<?php

namespace App\Filament\Core\Forms\Components\FileUpload;

use FF\Attachment\File\Contracts\MutipleUploader;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadButton extends Component
{
    use WithFileUploads;

    public string $buttonText = '';

    public bool $isMultiple = false;

    public string $fileRelatedName = '';

    #[Validate(['files.*' => 'max:1024'])]
    public $files;

    public function getAllowType(): string|null
    {
        $allowTypes = $this->fileRelatedName::getAllowType();
        if($allowTypes) {
            return implode(',', $allowTypes);
        }
        return null;
    }

    public function saveFiles()
    {
        $multipleUploader = app(MutipleUploader::class);
        $multipleUploader->setFiles($this->files);
        $result = $multipleUploader->upload();

        if (!$result) {
            return [
                'status' => false,
                'message' => $multipleUploader->getErrorMessage(),
            ];
        }

        return [
            'status' => true,
            'files' => $multipleUploader->getAttachments(),
        ];
    }

    public function render()
    {
        return view('filament.forms.components.file-upload.upload-button');
    }
}
