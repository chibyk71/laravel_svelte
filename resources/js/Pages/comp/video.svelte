<script lang="ts">
    import { ShowHeader, userHasInteracted } from "../../lib/util/userStore";
    import { onMount } from "svelte";
    import { PlaySolid } from "svelte-awesome-icons";
    import { fade } from "svelte/transition";

    let videoEl: HTMLVideoElement;
    export let src = '';
    let isPlaying = false;

    function handleVideoClick(event: MouseEvent & { currentTarget: EventTarget & HTMLVideoElement|HTMLDivElement; }) {
        $userHasInteracted = true;
        if (videoEl.paused) {  
            videoEl.play()
            isPlaying = true
        }else{
            videoEl.pause()
            isPlaying = false
        }
        $ShowHeader = videoEl.paused
    }

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!$userHasInteracted) {
                    return false
                }
                videoEl.play();
                isPlaying = true;
            } else {
                videoEl.pause();
                isPlaying = false;
            }
        });
    },{
        threshold: 1.0,
        root: document.querySelector('.swiper-wrapper')
    });

    onMount((async () => {
        observer.observe(videoEl);
    }))
</script>

<!-- svelte-ignore a11y-click-events-have-key-events -->
<!-- svelte-ignore a11y-no-static-element-interactions -->
<div class="swiper-slide relative" on:click={handleVideoClick}>
    <video bind:this={videoEl} loop>
        <source src="storage/{src}" type="video/mp4" />
        <track kind="captions" />
    </video>
    {#if !isPlaying}
        <div transition:fade class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full w-20 h-20 bg-slate-600/30 flex items-center justify-center">
            <svelte:component this={PlaySolid} class="w-10 h-10 fill-slate-200"/>
        </div>
    {/if}
</div>