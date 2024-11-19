<template>
    <div class="card mt-3">
        <div class="card-header well">
            <h3 class="card-title">File Uploads </h3>
        </div>
        <div class="p-2 row row-cards">
            <!-- Additional Information -->
            <div class="col-12">
                <div class="card-body row">
                    <div class="mb-3">
                        <label class="form-label">Select Files</label>
                        <form ref="dropzoneElement" class="dropzone"></form>
                        <table>
                            <tbody> 
                                <tr>
                                    <td ><b>  Allowed File Types:</b>  </td>
                                    <td >
                                        .doc, .docx, .xls, .xlsx, .txt, .csv, .pdf, .jpg, .tif, .tiff, .zip, .mp3, .msg,
                                        .avi, .mov, .wmv, .mp4
                                    </td>
                                </tr>
                                <tr>
                                    <td><b> Maximum File Size:</b> </td>
                                    <td >  100MB  </td>
                                </tr>
                                <tr >
                                    <td> <b> Maximum File Count: </b>  </td>
                                    <td >  10 Files </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--End Additional Information -->




        </div>
    </div>
</template>

<script setup>

import { ref, onMounted, onBeforeUnmount } from 'vue';
import Dropzone from 'dropzone';

const dropzoneElement = ref(null);

onMounted(() => {
    const dropzoneOptions = {
        url: '/upload',
        paramName: 'file',
        maxFiles: 10,
        maxFilesize: 100,
        addRemoveLinks: true,
        acceptedFiles: ".doc,.docx,.xls,.xlsx,.txt,.csv,.pdf,.jpg,.tif,.tiff,.zip,.mp3,.msg,.avi,.mov,.wmv,.mp4",
        // headers: {
        //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        // },
        init: function () {
            this.on('success', function (file, response) {
                console.log('Upload successful', response);
            });

            this.on('error', function (file, errorMessage) {
                console.error('Upload failed', errorMessage);
            });
        },
    };

    new Dropzone(dropzoneElement.value, dropzoneOptions);
});

onBeforeUnmount(() => {
    Dropzone.forElement(dropzoneElement.value)?.destroy();
});
</script>

<style>
    @import 'dropzone/dist/dropzone.css';
</style>