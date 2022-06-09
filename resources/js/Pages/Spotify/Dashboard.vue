<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'
export default {
    components: {
        Head,
        BreezeAuthenticatedLayout,
        Link
    },
    props: {
        connected: Boolean,
        userInfo: Object,
        playlists: Object,
        offset: Number
    },
    methods: {
        fetchPlaylists(direction) {
            let offset = this.offset;
            if(direction === "next"){
                if((offset + 10) < this.playlists.total){
                    offset = offset + 10;
                }
            }else{
                if((offset - 10 ) >= 0){
                    offset = offset - 10;
                }
            }
            var url = route('spotify.dashboard') + '?offset=' + offset;
            Inertia.visit(url, {
                only: ['playlists', 'offset'],
            })
        },

    }

}

</script>

<template>
    <Head title="Spotify Dashboard" />

    <BreezeAuthenticatedLayout>


            <div class="grid grid-cols-3 gap-4 items-center align-middle justify-center text-center">
                <div>

                </div>
                <div class="flex justify-center" >
                    <div class="mt-5 w-full" v-if="!connected">
                        <Link :href="route('spotify.auth.redirect')"  class="py-2 max-w-md px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                            Connect With Spotify
                        </Link>

                    </div>

                    <div class="mt-5 w-full" v-else>

                        <div class="flex items-center space-x-4">
                            <img class="w-20 h-20 rounded-full" :src="userInfo.images[0]['url']" alt="">
                            <div class="space-y-1 font-medium ">
                                <div>Welcome  {{ userInfo.display_name }} </div>
                            </div>
                            <Link :href="route('spotify.auth.revoke')"  class=" flex py-2 max-w-md px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-md ">
                                Sign-Out of Spotify
                            </Link>
                        </div>
                        <div class=" mt-5 p-4 w-100  rounded-lg border shadow-md sm:p-8">
                            <div class="flex justify-between items-center mb-4">
                                <h5 class="text-xl font-bold leading-none text-gray-900 ">Playlists</h5>
                                <button type="button" v-if="(offset - 10 ) >= 0"   @click="fetchPlaylists('previous')" class="text-sm font-medium text-blue-600 hover:underline ">
                                    Previous
                                </button>
                                <button type="button" v-if="(offset + 10) < playlists.total"  @click="fetchPlaylists('next')" class="text-sm font-medium text-blue-600 hover:underline ">
                                    Next
                                </button>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200 " :key="offset">

                                    <li v-for="playlist in playlists.items" class="py-3 sm:py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img v-if="playlist.images.length > 0" class="w-12 h-12 rounded-full" :src="playlist.images[0]['url']" >
                                                <img v-else class="w-12 h-12 rounded-full" >
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <a target='_blank'  :href="playlist.external_urls.spotify" class="text-sm font-large text-gray-900 hover:text-blue-600 truncate ">
                                                    <span v-if="playlist.name.length<60">{{playlist.name}}</span>
                                                    <span v-else>{{playlist.name.substring(0,60)+".." }}</span>
                                                </a>
                                                <p class="text-sm text-gray-500 truncate ">
                                                   Number of Tracks: {{ playlist.tracks.total}}
                                                </p>
                                            </div>
                                            <div class="inline-flex items-center">
                                                <a class="inline-flex items-center h-8 px-4 m-2 text-sm text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800"
                                                      target='_blank' :href="playlist.external_urls.spotify"  > View</a>

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
