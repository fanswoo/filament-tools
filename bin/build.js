import compile from './builder.js';

compile({
  entryPoints: ['./resources/js/forms/file-upload/file-upload.js'],
  outfile: './resources/dist/forms/file-upload/file-upload.js',
  outfile2: '../investment/public/js/fanswoo/filament-tools/forms/file-upload/components/file-upload.js',
});

compile({
  entryPoints: ['./resources/js/forms/file-upload/upload-button.js'],
  outfile: './resources/dist/forms/file-upload/upload-button.js',
  outfile2: '../investment/public/js/fanswoo/filament-tools/forms/file-upload/components/upload-button.js',
});

compile({
  entryPoints: ['./resources/js/forms/file-upload/upload-list.js'],
  outfile: './resources/dist/forms/file-upload/upload-list.js',
  outfile2: '../investment/public/js/fanswoo/filament-tools/forms/file-upload/components/upload-list.js',
});

compile({
  entryPoints: ['./resources/scss/core.scss'],
  outfile: './resources/dist/css/core.css',
  outfile2: '../investment/public/css/fanswoo/filament-tools/css/core.css',
});