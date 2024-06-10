
<script>
    import { onMount } from "svelte";
    import Video from "./video.svelte";
    import Swiper from "swiper";
    import { Pagination } from "swiper/modules";

    export let medias
    let swiperEl;
    onMount(()=>{
        if (medias.length > 1) {
                const swiper = new Swiper(swiperEl,{
                slidesPerView: 1,
                loop:false,
                pagination:{
                    type: "fraction",
                    el:".swiper-pagination"
                },
                modules:[Pagination]
            });
        }
    })
</script>
<div class="swiper relative" bind:this={swiperEl}>
    <div class="swiper-wrapper">
        {#each medias as media}
            {#if media.type == "image"}
                <img class="reel swiper-slide" src="storage/{media.path}" alt="" />
            {:else}
                <Video src={media.path} />
            {/if}
        {/each}
    </div>
    {#if medias.length > 1}
         <div class="absolute top-4 z-10 right-4 swiper-pagination bg-slate-300/30 px-2 py-1 rounded-2xl text-slate-300"></div>
    {/if}
</div>