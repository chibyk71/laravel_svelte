<script lang="ts">
	import { isfixed } from '../lib/util/headerFixed';
	import { onMount } from 'svelte';
	// import Swiper JS
	import Swiper from 'swiper';
    import { Pagination , Autoplay} from 'swiper/modules';
	// import Swiper styles
	import 'swiper/css';
    import Layout from './shared/layout.svelte';
    import Title from './shared/title.svelte';

    $isfixed = false
    onMount(()=> {
        const swiper = new Swiper(".get-started",{
            parallax: true,
			slidesPerView: 1,
			spaceBetween: 0,
			autoplay: true,
			pagination: {
                el: ".swiper-pagination",
                type: "bullets"
			},
            modules: [Pagination,Autoplay],
		});

    })
    
</script>

<Title title="Welcome" />
<Layout>
    <!-- Welcome Start -->
	<div class="content-body">
		<div class="container h-screen">
			<div class="welcome-area">
				<div class="bg-image bg-image-overlay" style="background-image: url(images/login/pic1.jpg);"></div>
				<div class="join-area">
					<div class="mb-3">
                        <div class="swiper swiper-container get-started">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="started">
										<h1 class="title">Hello, And Welcome to Soziety.</h1>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="started">
										<h1>People's First Prefrence Is Soziety</h1>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="started">
										<h1>Expand Your Network With Soziety</h1>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
									</div>
								</div>
							</div>
                            <div class="swiper-btn">
                                <div class="swiper-pagination style-1 flex-1"></div>
                            </div>
						</div>
					</div>
					<a href="/register" class="btn btn-primary btn-block mb-3 text-center">CREATE ACCOUNT</a>
					<a href="/login" class="btn btn-light btn-block mb-3 text-center">SIGN IN</a>
					<a href="/forgotpassword" class="text-light text-center block">Forgot your account?</a>
				</div>
			</div>
		</div>
	</div>
    <!-- Welcome End -->
</Layout>