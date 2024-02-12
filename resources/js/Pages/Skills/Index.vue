<template>
     <Head title="Skills Index" > </Head>


        <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Skills</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <div class="flex justify-end m-2 p-2">
            <Link :href="route('skills.create')" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded-md">New Skill</Link>
           </div>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-black-500 dark:text-black-400">
        <thead class="text-xs text-black-200 uppercase bg-gray-50 dark:bg-gray-300 dark:text-black-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                   Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>

            </tr>
        </thead>
        <tbody>


            <tr v-for="skill in skills.data" :key="skill.id">
                <th scope="row" class="px-6 py-4 font-medium text-black-900 whitespace-nowrap dark:text-black">
                  {{skill.id}}
                </th>
                <td class="px-6 py-4 dark:text-black ">
                    {{skill.name}}
                </td>
                <td class="px-6 py-4 dark:text-black w-40 h-20 rounded-full">
                  <img :src="skill.image" >
                </td>

                <td class="px-6 py-4 dark:text-black">
                    <!-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</a> -->
                    <Link :href="route('skills.edit',skill.id)" class="font-medium text-blue-500 hover:text-blue-700 mr-2">Edit</Link>
                    <Link :href="route('skills.destroy',skill.id)" method="delete" class="font-medium text-red-500 hover:text-red-700 mr-2">Delete</Link>
                </td>
            </tr>
        </tbody>
    </table>
</div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';

defineProps({
    skills:Object
});
</script>
