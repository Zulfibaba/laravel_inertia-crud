<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    topics: Array

})
</script>

<template>
    <Head title="Topics" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics</h2>
        </template>

        <div class="py-12 pt-2">

            <div class="relative max-w-6xl mx-auto overflow-x-auto shadow-md sm:rounded-lg">
                <div v-if="$page.props.flash.message" class="mb-4">
                    <div
                        class="transition-opacity duration-100 ease-in-out bg-green-200 border-l-4 border-green-500 text-green-700 p-4">
                        {{ $page.props.flash.message }}
                    </div>
                </div>

                <div class="flex justify-end m-2 p-2">
                    <Link href="/topics/create" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded">
                    Create</Link>
                </div>

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead
                        class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="topic in topics" :key="topic.id"
                            class="bg-white border-b text-center dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row">
                                <div class="pl-3">
                                    <div class="text-base font-semibold">{{ topic.name }}</div>
                                </div>
                            </th>

                            <td class="px-6 py-4 flex align items-center justify-center">
                                <a target="_blank" :href="topic.image">
                                    <img :src="topic.image" class="w-12 h-12 rounded" />
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <div class="space-x-4">
                                    <Link :href="`/topics/${topic.id}/edit`"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline bg-blue-100 hover:bg-blue-200 px-2 py-1 rounded">
                                    Edit
                                    </Link>
                                    <Link :href="`/topics/${topic.id}`" method="delete" as="button" type="button"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline bg-red-100 hover:bg-red-200 px-2 py-1 rounded">
                                    Delete
                                    </Link>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
      