<script lang="ts">
	import TopBar from '../lib/nav/topBar.svelte';
	import { HeartRegular, HeartSolid } from 'svelte-awesome-icons';
	import InfiniteLoading, { type InfiniteEvent } from 'svelte-infinite-loading';
	import Replies from './replies.svelte';
    import axios from 'axios';
    import type { Comment, CommentsData, User } from '../lib/type';
    import { UserAvatar } from '../lib/util/userStore';
    import Title from './shared/title.svelte';
	export let user: User;
	let infiniteId = Symbol();
	export let comments: CommentsData;
    let nextPage = comments.next_page_url
    const path = comments.path
    // console.log(comments.data);
	
	let replyTo:number|null = null;

	async function infiniteHandler({ detail: { loaded, complete } }: InfiniteEvent) {
        if (!nextPage) {
            complete()
            return false;
        }
		await axios.post(nextPage)
		.then((result) => {
            let {data} = result.data as CommentsData
			if (data.length) {
				comments.data = [...comments.data, ...data];
                nextPage = result.data.next_page_url
				loaded();
			} else {
				complete();
			}
		});
	}

	async function likeComment(e: MouseEvent & { currentTarget: EventTarget & HTMLAnchorElement; },index: number) {
		let comment = comments.data[index];
		comment.likes_count += comment.isliked?-1:1;
		comment.isliked = !comment.isliked
		const res = await axios.post(`${location.origin}/comment/${comment.id}/${!comment.isliked?"unlike":"like"}`)
		.then((r)=>r);

		if (res?.status == 200) {
			comments.data[index] = comment
		}
	}


    async function handleCommentSubmit(event: SubmitEvent & { currentTarget: EventTarget & HTMLFormElement; }) {
		const form = event.currentTarget
        let formData = new FormData(form); 
        await axios.post(path,formData)
        .then(({status,data})=>{
            if (status >= 300) {
                // TODO toast error
                console.log(data);
                
                return
            }
			
			let newComent:Comment = data.comment
			newComent.isliked = false;
			newComent.likes_count = 0;
			newComent.commenter = user     
			comments.data.unshift(newComent)       
			comments.data = comments.data

			form.reset()
            
        })
    }

    async function handleReplySubmit(event: SubmitEvent & { currentTarget: EventTarget & HTMLFormElement; }) {
        const form = event.currentTarget
        let formData = new FormData(form);
		let connentId = comments.data[replyTo!].id
        await axios.post("/reply/"+connentId,formData)
        .then(({status,data})=>{
            if (status >= 300) {
                // TODO toast error
                console.log(data);
                return
            }
			replyTo = null;
			comments.data[replyTo!].replies += 1
			form.reset()  
        })
    }
</script>

<Title title="Comment" />
<TopBar title="comment" />

<!-- Page Content -->
<div class="page-content">
	<div class="container profile-area bottom-content">
		<ul class="dz-comments-list">
			{#each comments.data as { id, commenter, content, likes_count ,isliked, replies },index (id)}
				<!-- svelte-ignore a11y-click-events-have-key-events -->
				<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
				<li class="flex-wrap" on:click={()=>replyTo=index}>
					<div class="list-content">
						<img src={commenter.avatar} alt="/" />
						<div>
							<h6 class="font-semibold text-[var(--title)] capitalize text-sm/none mb-1">{commenter.name}</h6>
							<p class="!mb-2">{content}</p>
							<ul class="bottom-item">
								<li class="text-light">{likes_count} Like</li>
								<li class="text-light">Reply</li>
								<li class="text-light">Send</li>
							</ul>
						</div>
					</div>
					<div class="ml-auto">
						<a href={void(0)} on:click|preventDefault={(e) => { likeComment(e,index); }} class="like-button" class:active={isliked}><svelte:component this={isliked?HeartSolid:HeartRegular} class="ml-auto w-4 h-4" /></a>
					</div>
					{#key replies}
						<Replies commentId={id} />
					{/key}
				</li>
			{/each}
			<InfiniteLoading on:infinite={infiniteHandler} identifier={infiniteId}>
					<p slot="noResults">{!comments.data.length?"Be the first to leave a comment":""}</p>
			</InfiniteLoading>
		</ul>
	</div>
	<footer class="footer fixed border-t boder-t-[#e6e6e6]">
		<div class="container py-2">
			<div class="commnet-footer">
				<div class="flex items-center flex-1">
					<div class="media media-40 rounded-circle">
						<img src={UserAvatar(user.name)} alt="/" />
					</div>
					{#if replyTo == null}
						<form id="commentform" class="flex-1" on:submit|preventDefault={handleCommentSubmit}>
							<input type="text" name="content" class="form-control" placeholder="Add a Comments..." />
						</form>
					{:else}
						<!-- svelte-ignore a11y-autofocus -->
						<form action="/reply/{replyTo}" method="post" id="commentform" class="flex-1" on:submit|preventDefault={handleReplySubmit}>
							<input on:blur={()=>setTimeout(()=>replyTo = null,400)} autofocus type="text" name="content" class="form-control" placeholder="Add a Reply..." />
						</form>
					{/if}
				</div>
				<button form="commentform" class="send-btn">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path
							d="M21.4499 11.11L3.44989 2.11C3.27295 2.0187 3.07279 1.9823 2.87503 2.00546C2.67728 2.02862 2.49094 2.11029 2.33989 2.24C2.18946 2.37064 2.08149 2.54325 2.02982 2.73567C1.97815 2.9281 1.98514 3.13157 2.04989 3.32L4.99989 12L2.09989 20.68C2.05015 20.8267 2.03517 20.983 2.05613 21.1364C2.0771 21.2899 2.13344 21.4364 2.2207 21.5644C2.30797 21.6924 2.42378 21.7984 2.559 21.874C2.69422 21.9496 2.84515 21.9927 2.99989 22C3.15643 21.9991 3.31057 21.9614 3.44989 21.89L21.4499 12.89C21.6137 12.8061 21.7512 12.6786 21.8471 12.5216C21.9431 12.3645 21.9939 12.184 21.9939 12C21.9939 11.8159 21.9431 11.6355 21.8471 11.4784C21.7512 11.3214 21.6137 11.1939 21.4499 11.11ZM4.70989 19L6.70989 13H16.7099L4.70989 19ZM6.70989 11L4.70989 5L16.7599 11H6.70989Z"
							fill="#40189D"
						/>
					</svg>
				</button>
			</div>
		</div>
	</footer>
</div>
<!-- Page Content End-->
