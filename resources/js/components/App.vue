<template>
    <div>
        <div class="mt-4">
            <file-pond
                name="image"
                ref="pond"
                label-idle="Clik to choose image or drag here..."np
                credits="false"
                accepted-file-types="image/*"
                @processfile="handleProcessedFile"
                allowImagePreview="true"
            />
        </div>
        <div class="mt-8 mb-24">
            <h3 class="text-2xl font-medium text-center">Image Gallery</h3>
            <div class="grid grid-cols-3 gap-2 justify-evenly mt-4">
                <div v-for="(image, index) in images" :key="index">
                    <img class="rounded" :src="'/storage/images/' + image">
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vueFilePond, { setOptions } from 'vue-filepond';
import "filepond/dist/filepond.min.css";
import FilePondPluginValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';

setOptions({
    server: {
        process: {
            url: './upload',
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf_token"]').content
            }
        }
    }
})

const FilePond = vueFilePond(FilePondPluginValidateType, FilePondPluginImagePreview, FilePondPluginImageExifOrientation);

export default {
    components: {
        FilePond
    },
    data() {
        return {
            images: []
        }
    },
    mounted() {
        axios.get('/images')
            .then((response) => {
                this.images = response.data
            })
            .catch((error) => {
                console.error(error)
            });
    },
    methods: {
        handleProcessedFile(error, file) {
            if (error) {
                console.error(error);
                return;
            }
            // append the file into the images array
            this.images.unshift(file.serverId);
        }
    }
}
</script>
