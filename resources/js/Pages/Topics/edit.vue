<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    topic: Object,
    image: String
});

const form = useForm({
    name: props.topic.name,
    image: null,
    topic_id: props.topic.id
})
function updateTopic() {
    form.post(route('topics.update'))
}

</script>

<template>
    <Head title="Edit Topics" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Topics</h2>
        </template>
        <div class="flex m-2 p-2">
            <Link href="/topics" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded">
            Back</Link>
        </div>

        <div class="flex justify-center">
            <div class="relative  m-12 overflow-x-auto shadow-md sm:rounded-lg">
                <div v-if="$page.props.flash.message" class="text-Green-600 mb-4">
                    {{ $page.props.flash.message }}
                </div>
                <form @submit.prevent="updateTopic">
                    <div class="m-12">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                        <input type="text" id="name" name="name" v-model="form.name"
                            class=" px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                            placeholder="Enter your name" />
                    </div>

                    <div class=" m-12">
                        <label for="file" class="block text-gray-700 font-bold mb-2">Upload File</label>
                        <div class="m-2 p-2">
                            <img :src="image" class="w-20 h-20" />
                        </div>
                        <input type="file" id="image" name="image" @input="form.image = $event.target.files[0]"
                            class=" px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" />
                        <button type="submit"
                            class="flex bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-4 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
