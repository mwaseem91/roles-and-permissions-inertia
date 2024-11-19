<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">File Uploads</h3>
        </div>
        <div class="p-2 row row-cards">
            <div class="col-12">
                <div class="card-body row">
                    <div class="mb-3">
                        <label class="form-label">Select Files</label>
                        <form ref="dropzoneElement" class="dropzone"></form>
                        <table>
                            <tbody>
                                <tr>
                                    <td><b>Allowed File Types:</b></td>
                                    <td>
                                        .doc, .docx, .xls, .xlsx, .txt, .csv, .pdf, .jpg, .tif, .tiff, .zip, .mp3, .msg,
                                        .avi, .mov, .wmv, .mp4
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Maximum File Size:</b></td>
                                    <td>100MB</td>
                                </tr>
                                <tr>
                                    <td><b>Maximum File Count:</b></td>
                                    <td>10 Files</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineExpose } from 'vue';
import Dropzone from 'dropzone';

const dropzoneElement = ref(null);
let dropzoneInstance = null;

onMounted(() => {
    const dropzoneOptions = {
        url: '/request-forms/file-upload', 
        paramName: 'file',
        maxFiles: 10,
        maxFilesize: 100,
        uploadMultiple: true,
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: ".doc,.docx,.xls,.xlsx,.txt,.csv,.pdf,.jpg,.tif,.tiff,.zip,.mp3,.msg,.avi,.mov,.wmv,.mp4",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },

        init: function () {
            dropzoneInstance = this;
            this.on('addedfile', function (file) {
                console.log('File added:',);
            });
            this.on('success', function (file, response) {
                console.log('Upload successful');
            });
            this.on('error', function (file, errorMessage) {
                console.error('Upload failed',);
            });
             // Triggered when a file is removed
             this.on('removedfile', function (file) {
                console.log('File removed:', file);
            });
        },
    };

    new Dropzone(dropzoneElement.value, dropzoneOptions);
});

onBeforeUnmount(() => {
    Dropzone.forElement(dropzoneElement.value)?.destroy();
});

// Method to manually trigger the file upload
const uploadFiles = () => {
    if (dropzoneInstance && dropzoneInstance.files.length > 0) {
        dropzoneInstance.processQueue();
    } else {
        console.warn('No files to upload');
    }
};

defineExpose({
    uploadFiles,
});
</script>

<style>
@import 'dropzone/dist/dropzone.css';
</style>