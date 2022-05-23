<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        BreezeAuthenticatedLayout,
        Link
    },
    props: {
        connected: Boolean,
        userInfo: Object,
        playlists: Array,
    },
}

</script>

<template>
    <Head title="Spotify Dashboard" />

    <BreezeAuthenticatedLayout>


            <div class="grid grid-cols-3 gap-4 items-center align-middle justify-center text-center">
                <div>

                </div>
                <div >
                    <div class="mt-5" v-if="!connected">
                        <Link :href="route('spotify.auth.redirect')"  class="py-2 max-w-md px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Connect With Spotify
                        </Link>

                    </div>

                    <div class="mt-5" v-else>

                        <div class="flex items-center space-x-4">
                            <img class="w-20 h-20 rounded-full" :src="userInfo.images[0]['url']" alt="">
                            <div class="space-y-1 font-medium dark:text-white">
                                <div>Welcome  {{ userInfo.display_name }} </div>
                            </div>
                            <Link :href="route('spotify.auth.revoke')"  class=" flex py-2 max-w-md px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-md ">
                                Revoke Spotify Access
                            </Link>
                        </div>
                        <div class=" mt-5 p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-4">
                                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Playlists</h5>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    View all
                                </a>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">

                                    <li v-for="playlist in playlists" class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="w-12 h-12 rounded-full" :src="playlist.images[0]['url']" >
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <Link :href="playlist.external_urls.spotify" class="text-sm font-large text-gray-900 hover:text-blue-600 truncate dark:text-white">
                                                    {{ playlist.name}}
                                                </Link>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                   Number of Tracks: {{ playlist.tracks.total}}
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center">
                                                <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800" :href="route('spotify.auth.revoke')" > View</a>

                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                <div>

                </div>
            </div>

    </BreezeAuthenticatedLayout>
</template>
