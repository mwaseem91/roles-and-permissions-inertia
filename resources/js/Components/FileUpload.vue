<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">Upload Files</h3>
        </div>
        <div class="p-2 row row-cards">
            <div class="col-12">
                <div class="card-body row">
                    <div class="mb-3">
                        <label class="form-label">Select Files</label>
                        <form ref="dropzoneElement" class="dropzone"></form>
                        <span v-if="errors['files']" class="text-danger">{{errors['files']}}</span>
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
import { useToastr } from '@/toaster';
const toastr = useToastr();


const dropzoneElement = ref(null);
const dropzoneFiles = ref([]);

// Initialize Dropzone
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
            this.on('addedfile', function (file) {
                console.log('File added:', file);
                dropzoneFiles.value.push(file); // Add file to the list
            });
            this.on('success', function (file, response) {
                console.log('Upload successful');
            });
            this.on('error', function (file, errorMessage) {
                this.removeFile(file);
            });
            this.on('removedfile', function (file) {
                console.log('File removed:', file);
                dropzoneFiles.value = dropzoneFiles.value.filter(f => f !== file); 
            });
        },
    };

    new Dropzone(dropzoneElement.value, dropzoneOptions);
});

// Clean up on unmount
onBeforeUnmount(() => {
    Dropzone.forElement(dropzoneElement.value)?.destroy();
});

// Expose the files array to the parent component
defineExpose({
    dropzoneFiles,
});

const props = defineProps({
    errors: Object 
});
</script>



<style>
@import 'dropzone/dist/dropzone.css';
</style>