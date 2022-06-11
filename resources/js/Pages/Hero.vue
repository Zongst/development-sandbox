
<script>
import { Link } from '@inertiajs/inertia-vue3';
import { Slide } from 'vue3-burger-menu'
export default {
    components: {
        Link,
        Slide
    },
    props: [
    ],
    data () {
        return {
        }
    },
    mounted () {
    },
    created () {
    },
    computed: {
    },
    methods: {
    },
    watch: {
    }
}
</script>
<template>
   <div class="hero-wrapper">
       <div class="hamburger-white">
           <Slide style="z-index: 9999;">
               <Link :href="route('Hero')">
                   <span>Home</span>
               </Link>
               <Link :href="route('spotify.dashboard')">
                   <span>Spotify</span>
               </Link>
           </Slide>
       </div>
       <div class="main">
           <div class="inner">
               <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md " style="background-color: #E9EAEC">

                   <div class="flex flex-col items-center pb-10 pt-5">
                       <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="/img/he-man-small.jpg" alt="Zing Image"/>
                       <h5 class="mb-1 text-3xl font-bold text-gray-900 ">Monty Hollings</h5>
                       <span class="text-lg text-gray-500 ">Software Developer</span>

                       <div class="projects pt-4 flex flex-col">
                       <span class="text-lg text-gray-900 ">Personal Projects:</span>
                           <Link  :href="route('spotify.dashboard')" class="inline-flex items-center h-10 px-5 mt-5 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                               <svg class="w-4 h-4 mr-3 fill-current" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                               <span>Spotify API Playground</span>
                           </Link>

                       </div>

                       <div class="w-full border-t border-gray-300 my-3"></div>

                       <div class="flex mt-4 space-x-3 lg:mt-6">
                           <img src="img/discord.svg" class="discord-svg" alt="Discord Logo"> <span class="text-lg">Zing#3821</span>
                       </div>
                   </div>
               </div>
           </div>
       </div>

   </div>
</template>

