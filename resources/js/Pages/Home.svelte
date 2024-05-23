<script lang="ts">
	import { isfixed } from '../lib/util/headerFixed';
	import { Splide, SplideSlide, SplideTrack } from '@splidejs/svelte-splide';
	import { BookmarkRegular, EllipsisVerticalSolid, EyeSlashRegular, HeartRegular, HeartSolid, SlidersSolid } from 'svelte-awesome-icons';
	import Canvas from '../lib/comp/canvas.svelte';
	import { canvas } from '../lib/comp/canvasStore';
    import { HomeData, Post } from '../lib/type';
    import { MoveEventDetail } from '@splidejs/svelte-splide/types';
    import axios from 'axios';
    
    $isfixed = false
	export let data:HomeData;
	let currentPage = data.current_page;
	let previousPage = data.prev_page_url;
	let nextPage = data.next_page_url;
	
	let loading = false
	
	const handleMoved = async (e:CustomEvent<MoveEventDetail> | undefined)=>{
		let detail = e?.detail;

		if (detail!.index != data.data.length -2) {
			return false
		}

		if (loading) {
			return false
		}

		if (!nextPage) {
			// TODO make a tost to show end of post or content
			return false
		}

		try {
			loading = true;
			const result = await axios.post(nextPage)
			let returnedData = result.data.data
			if (result.status < 300 && result.data.status) {
				data.data.push(...returnedData.data);
				if (data.data.length > 20) {
					data.data.splice(0,returnedData.data.lenght)
				}
				data.data = data.data
				nextPage = returnedData.next_page_url
				loading = false;
			}else{
				loading = false;
				// TODO handle error
			}
		} catch (error) {
			loading = false;
			console.log(error);
		}
	}

    function handleLike(e: MouseEvent & { currentTarget: EventTarget & HTMLAnchorElement; }, index:number): any {
		let item = data.data[index];
		let target = e.currentTarget;
		let activeDiv = target.querySelector(".like-button");
		activeDiv?.classList.toggle("active");
		item.isLiked = !item.isLiked;
		if (item.isLiked) {
			item.likes_count++;
		} else {
			item.likes_count--;
		}

		data.data[index] = item
    }
</script>

    <div class="page-content relative">
        <div class="top-content absolute top-2 left-0 w-full z-10 px-4">
            <div class="user-profile">	
                <h4 class="text-white text-center flex-1 !mb-0 text-xl/none font-semibold">Home</h4>
            </div>
        </div>
        <Splide on:moved={handleMoved} hasTrack={false} options={{direction:"ttb",height:"100vh",perPage:1,arrows:false,pagination:false,snap:true,dragMinThreshold:1}}>
            <SplideTrack>
                {#each data.data as item,index (item.id)}
                    <SplideSlide>
                        <div class="reel-area">
    						<div class="reel-section">
    							<div class="user-item">
    								<a href={void(0)}>
    									<div class="media media-40 rounded-circle">
    										<img src="storage/{item.medias[0].path}" alt="/">
    									</div>
    								</a>	
    								<div class="ms-2">	
										{item.caption}
    								</div>	
    							</div>
    							<div class="reel-actions">
    								<a href={void(0)} on:click={(e)=>handleLike(e,index)} class="r-btn">
    									<div class="like-button text-2xl/none" class:active={item.isLiked}>
                                            <svelte:component this={item.isLiked?HeartSolid:HeartRegular} />
                                        </div>
    									<span>{item.likes_count}</span>
    								</a>
    								<a href={void(0)} class="r-btn">
    									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.012 512.012" width="512" height="512" ><path d="M255.999 512C114.614 511.999-.001 397.383 0 255.998A256 256 0 0 1 74.98 74.98c99.989-99.971 262.089-99.956 362.059.033 87.177 87.193 99.82 224.139 30.081 325.819 3.229 13.319 21.796 50.976 38.887 81.044 4.829 8.496 1.857 19.298-6.638 24.127-5.328 3.029-11.845 3.085-17.224.148a934.2 934.2 0 0 0-38.23-19.527c-28.226-13.549-40.43-17.189-45.051-18.167-42.193 28.481-91.96 43.649-142.865 43.543zm0-476.611c-121.645 0-220.61 98.965-220.61 220.61s98.965 220.611 220.61 220.611a219.23 219.23 0 0 0 126.409-39.783c9.909-6.943 23.155-3.859 35.991.506 8.31 2.831 18.691 7.099 30.901 12.717-5.691-11.766-10.051-21.759-12.979-29.751-5.41-14.762-7.64-26.513-.94-35.85A219.05 219.05 0 0 0 476.611 256c0-121.646-98.966-220.611-220.612-220.611z"/></svg>
    								</a>
    								<a href={void(0)} class="r-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom1" aria-controls="offcanvasBottom">
    									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.001 512.001" ><path d="M507.608 4.395a15 15 0 0 0-16.177-3.321L9.43 193.872a15 15 0 0 0-9.42 13.395 15 15 0 0 0 8.445 14.029l190.068 92.181 92.182 190.068A15 15 0 0 0 304.198 512l.536-.01a15 15 0 0 0 13.394-9.419l192.8-481.998a15 15 0 0 0-3.32-16.178zM52.094 209.118L434.72 56.069 206.691 284.096 52.094 209.118zm250.789 250.789l-74.979-154.599 228.03-228.027-153.051 382.626z"/></svg>
    								</a>
    								<a href={void(0)} on:click={()=>canvas.open("reels")} class="r-btn pb-0" aria-controls="offcanvasBottom">
                                        <EllipsisVerticalSolid />
    								</a>
    							</div>
    						</div>
    						{#each item.medias as media}
								{#if media.type == "image"}
									<img class="reel" src="storage/{media.path}" alt="">
								{:else}
									<video autoplay loop muted>
										<source src="storage/{media.path}" type="video/mp4">
									</video>
								{/if}
							{/each}
    					</div>
                    </SplideSlide>
                {/each}
            </SplideTrack>
        </Splide>
    </div> 

<Canvas class="reel-canvas" id="reels">
	<svelte:fragment slot="body">
		<ul class="features-list">
			<li>
				<a href={void(0)}>
					<div class="dz-icon">
						<BookmarkRegular />
					</div>
					<span>Save</span>
				</a>
			</li>
			<li>
				<a href={void(0)}>
					<div class="dz-icon">
						<SlidersSolid />
					</div>
					<span>Edit</span>
				</a>
			</li>
			<li>
				<a href={void(0)}>
					<div class="dz-icon">
						<EyeSlashRegular />
					</div>
					<span>Not Intrested</span>
				</a>
			</li>
		</ul>
	</svelte:fragment>
</Canvas>