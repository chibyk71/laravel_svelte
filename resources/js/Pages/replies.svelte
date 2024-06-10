<script lang="ts">
	import { HeartRegular, HeartSolid } from "svelte-awesome-icons";
	import InfiniteLoading, { type InfiniteEvent } from "svelte-infinite-loading";
    import { Reply } from "../lib/type"; 
    import axios from "axios";

    export let commentId:number

	let replies:Reply[] = [];
	let nextPage = '/reply/'+commentId;

	async function likeReplies(index: number) {
		let reply = replies[index];
		reply.likes_count += reply.isliked?-1:1;
		reply.isliked = !reply.isliked
		const res = await axios.post(`/reply/${reply.id}/${!reply.isliked?"unlike":"like"}`)
		.then((r)=>r);

		if (res?.status == 200) {
			replies[index] = reply
		}
	}

    async function fetchReplies({ detail: { loaded, complete } }: InfiniteEvent) {
		if (!nextPage) {
			complete();
			return false
		}

		await axios.get(nextPage)
		.then(({data}) => {
			if (data?.replies?.data.length) {
				replies = [...replies, ...data.replies.data];
				nextPage = data.replies.next_page_url;
				loaded();
			} else {
				complete();
			}
		});
	}
</script>

<ul class="w-full mt-4 overflow-y-auto overflow-x-hidden max-h-52">
	{#if replies}
		{#each replies as { id, replier, content, likes_count, isliked },index (id)}
			<li class="parent-list">
				<div class="list-content">
					<img src={replier?.avatar} alt="/" />
					<div>
						<h6 class="text-sm/none mb-1 font-semibold capitalize">{replier.name}</h6>
						<p class="mb-2">{content}</p>
						<ul class="bottom-item">
							<li class="text-light">{likes_count} like</li>
						</ul>
					</div>
				</div>
				<div class="ml-auto">
					<a href={void 0} on:click={()=>{likeReplies(index);}} class="like-button" class:active={isliked}>
						<svelte:component this={isliked?HeartSolid:HeartRegular} class="ml-auto w-4 h-4" />
					</a>
				</div>
			</li>
		{/each}
	{/if}
    <InfiniteLoading on:infinite={fetchReplies}>
		<p slot="noResults"></p>
	</InfiniteLoading>
</ul>
