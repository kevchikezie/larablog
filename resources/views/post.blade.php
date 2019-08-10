<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tailwind.css') }}">
	<title>Larablog</title>
</head>

<body class="bg-white font-sans leading-normal tracking-normal">

	<nav id="header" class="fixed w-full z-10 top-0 shadow-sm">

		<div id="progress" class="h-1 z-20 top-0"
			style="background:linear-gradient(to right, #d6bcfa var(--scroll), transparent 0);"></div>

		<div class="w-full md:max-w-5xl mx-auto flex flex-wrap items-center justify-between mt-0 py-2">

			<div class="pl-0">
				<a class="text-gray-900 text-base no-underline hover:no-underline font-serif font-bold text-3xl" href="#">
					Larablog
				</a>
			</div>

			<div class="block lg:hidden pr-4">
				<button id="nav-toggle"
					class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-purple-500 appearance-none focus:outline-none">
					<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<title>Menu</title>
						<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
					</svg>
				</button>
			</div>

			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-100 md:bg-transparent z-20"
				id="nav-content">
				<ul class="list-reset lg:flex justify-end flex-1 items-center">
					<li class="mr-1">
						<a class="inline-block py-2 px-3 text-gray-600 font-normal no-underline hover:text-gray-900 text-sm tracking-wider" href="#">CATEGORIES</a>
					</li>
					<li class="mr-1">
						<a class="inline-block py-2 px-3 text-gray-600 font-normal no-underline hover:text-gray-900 text-sm tracking-wider" href="#">ABOUT</a>
					</li>
					<li class="mr-0">
						<a class="inline-block py-2 px-3 text-gray-600 font-normal no-underline hover:text-gray-900 text-sm tracking-wider" href="#">CONTACT</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!--Container-->
	<div class="container w-full md:max-w-3xl mx-auto pt-16">

		{{-- Post content begins here --}}
		<div class="w-full px-5 md:px-10 pt-1 text-1xl text-gray-900 leading-relaxed" style="font-family:Georgia,serif;">

			<!--Title-->
			<div class="font-sans pb-10">
				<h1
					class="font-medium font-serif break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4.5xl leading-tight tracking-normal">
					Using PHP Traits for Laravel Eloquent Relationships
				</h1>
				<div class="flex w-full items-center font-sans px-0 pt-2 pb-0">
					<a href="#"><img class="w-12 h-12 rounded-full mr-2" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar of Author"></a>
					<div class="flex-1 px-1">
						<a href="#" class="font-normal text-sm md:text-sm leading-none hover:underline mb-2">Jo Bloggerson</a>
						<p class="text-sm md:text-sm font-normal text-gray-600 tracking-wide">Published Feb 19, 2019</p>
					</div>
				</div>
			</div>
			{{-- Title ends here --}}


			<!--Post Content-->
			<p class="pb-10">
				Welcome fellow Tailwind CSS and miminal monochrome blog fan. This starter
				template provides a starting point to create your own minimal monochrome blog using Tailwind CSS and vanilla Javascript. I recently began refactoring a bunch of code on a project and found myself putting the same methods on my Eloquent models for a relation to an Account class. FYI I prefer to have getters and setters rather than accessing properties magically.
			</p>

			<p class="pb-10">
				The basic blog page layout is available and all using the default Tailwind CSS classes 👋  (although there are a few hardcoded style tags). If you are going to use this in project, you will want to convert the classes into components.
			</p>

			<p class="pb-10">
				Sed dignissim lectus ut tincidunt vulputate. Fusce tincidunt lacus purus, in mattis tortor sollicitudin pretium. Phasellus at diam posuere, scelerisque nisl sit amet, tincidunt urna Cras nisi diam, pulvinar ut molestie eget, eleifend ac magna. Sed at lorem condimentum, dignissim lorem eu, blandit massa. Phasellus eleifend turpis vel erat bibendum scelerisque. Maecenas id risus dictum, rhoncus odio vitae, maximus purus. Etiam efficitur dolor in dolor molestie ornare. Aenean pulvinar diam nec neque tincidunt, vitae molestie quam fermentum. Donec ac pretium diam. Suspendisse sed odio risus. Nunc nec luctus nisi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis nec nulla eget sem dictum elementum.
			</p>


			<blockquote class="border-l-4 border-purple-500 italic my-8 pl-8 md:pl-12">
				Example of blockquote - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo posuere et sit amet ligula.
			</blockquote>

			<p class="pb-10">Example code block:</p>
			<pre class="bg-gray-900 rounded text-white font-mono text-base px-2 py-1 md:px-4 md:py-1 mb-10">
				<code class="break-words whitespace-pre-wrap">
&lt;header class="site-header outer"&gt;
&lt;div class="inner"&gt;
{&gt; "site-nav"}
&lt;/div&gt;
&lt;/header&gt;
				</code>
			</pre>

			<p class="pb-10">
				We can then tidy up our Post model from above to use this Trait, so it would look something like this:
			</p>

			<pre class="bg-gray-900 rounded text-white font-mono text-base px-2 py-1 md:px-4 md:py-1 mb-10">
				<code class="break-words whitespace-pre-wrap">
{!! htmlentities('<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	
</body>
</html>') !!}
				</code>
			</pre>

			<h4 class="mt-5 mb-2 font-bold font-sans text-3xl">Conclusion</h4>
			<p class="pb-0"> {{-- NOTE: write a css rule to set the last paragraph to padding bottom: 0 --}}
				Using traits means we can create DRY code when defining relationships to the same source. It could also speed up development, depending on how many relationships exist in your application.
			</p>
		</div>
		{{-- Post content ends here --}}
		<!--Tags -->
		<div class="text-base md:text-sm text-gray-500 px-5 md:px-10 py-10">
			{{-- <a href="#" class="text-base md:text-sm text-purple-500 no-underline hover:underline">Laravel</a>  --}}
			<a href="#" class="bg-gray-300 py-2 px-2 mr-1 text-xs font-sans tracking-wider text-gray-800 rounded">Laravel</a>
			<a href="#" class="bg-gray-300 py-2 px-2 mr-1 text-xs font-sans tracking-wider text-gray-800 rounded">Traits</a>
			<a href="#" class="bg-gray-300 py-2 px-2 mr-1 text-xs font-sans tracking-wider text-gray-800 rounded">PHP</a>
			<a href="#" class="bg-gray-300 py-2 px-2 mr-1 text-xs font-sans tracking-wider text-gray-800 rounded">Eloquent</a>
		</div>

		<!--Divider-->
		<hr class="border-b-0 border-gray-400 mb-0 mx-5 md:mx-10">

		<!--Author-->
		<div class="flex w-full items-center font-sans px-10 py-8">
			<a href="#">
				<img class="w-20 h-20 rounded-full mr-4" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar of Author">
			</a>
			<div class="flex-1">
				<p class="tracking-wide text-gray-700 font-normal text-uppercase text-sm md:text-sm leading-none mb-3">WRITTEN BY</p>
				<a href="#" class="text-base font-bold text-base md:text-2xl leading-none mb-4">Jo Bloggerson</a>
				<p class="text-gray-700 text-xs md:text-base leading-relaxed mt-3">
					Minimal Blog Tailwind CSS template by So lets say we have a Post model that looks something like this same methods on my.
				</p>
			</div>
			<div class="justify-end">
				<a href="#"
					class="bg-transparent border border-gray-500 hover:border-purple-500 text-xs text-gray-500 hover:text-purple-500 font-normal tracking-wide py-2 px-4 rounded-full">Read
					More</a>
			</div>
		</div>
		<!--/Author-->

		<hr class="border-b-0 border-gray-400 mb-0 mx-5 md:mx-10">


		<!--Subscribe-->
		<div class="container px-5 md:px-10 mt-16">
			<div class="font-sans bg-white rounded-lg border border-gray-200 shadow-lg p-4 pb-8 text-center">
				<h2 class="font-extrabold break-normal text-xl md:text-3xl">Subscribe to our Newsletter</h2>
				<h3 class="break-normal font-normal tracking-wide text-gray-600 text-sm md:text-base">Get the latest posts
					delivered right to your inbox</h3>
				<div class="w-full text-center pt-4">
					<form action="#">
						<div class="max-w-xl mx-auto p-1 pr-0 flex flex-wrap items-center">
							<input type="email" placeholder="youremail@example.com"
								class="flex-1 mt-4 appearance-none border border-gray-400 rounded shadow-md p-3 text-gray-600 mr-2 focus:outline-none">
							<button type="submit"
								class="flex-1 mt-4 block md:inline-block appearance-none bg-purple-500 text-white text-base font-semibold tracking-wider uppercase py-4 rounded shadow hover:bg-purple-400">Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Subscribe-->



		

		<!--Divider-->
		{{-- <hr class="border-b-2 border-gray-400 mb-8 mx-4"> --}}

		<!--Next & Prev Links-->
		{{-- <div class="font-sans flex justify-between content-center px-4 pb-12">
			<div class="text-left">
				<span class="text-xs md:text-sm font-normal text-gray-600">&lt; Previous Post</span><br>
				<p><a href="#"
						class="break-normal text-base md:text-sm text-purple-500 font-bold no-underline hover:underline">Blog
						title</a></p>
			</div>
			<div class="text-right">
				<span class="text-xs md:text-sm font-normal text-gray-600">Next Post &gt;</span><br>
				<p><a href="#"
						class="break-normal text-base md:text-sm text-purple-500 font-bold no-underline hover:underline">Blog
						title</a></p>
			</div>
		</div> --}}


		<!--/Next & Prev Links-->

	</div>
	<!--/container-->

	<div class="bg-gray-100 w-full mx-auto pt-12 pb-12 mt-20">

		<div class="container w-full md:max-w-5xl mx-auto">
			<div class="mb-10 border-b px-5 md-px-0">
				<p class="pb-3 font-bold tracking-wide font-sans text-xl">Related Posts</p>
			</div>

			<div class="md:flex px-5">
				<div class="w-full md:w-1/3 md:pl-0 md:pr-4 pb-12">
					<div class="max-w-sm overflow-hidden">
						<a href="#">
							<img class="w-full" src="{{ asset('assets/img/card-top.jpg') }}" alt="Sunset in the mountains">
						</a>
						<div class="px-0 py-3">
							<a href="#" class="font-normal font-serif text-2xl mb-2 leading-tight inline-block no-underline hover:no-underline">How I Managed To Control Chaos With Laravel</a>
						</div>
						
						<div class="flex w-full items-center font-sans px-0 pt-0 pb-0">
							<a href="#">
								<img class="w-10 h-10 rounded-full mr-1" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar of Author">
							</a>
							<div class="flex-1 px-1">
								<a href="#" class="font-normal text-sm md:text-sm leading-none mb-1 inline-block hover:underline">Marcel Domke</a>
								<p class="text-xs md:text-xs font-normal text-gray-600 tracking-wider">Feb 19, 2019</p>
							</div>
						</div>
					</div>
				</div>

				<div class="w-full md:w-1/3 md:px-2 pb-12">
					<div class="max-w-sm overflow-hidden">
						<a href="#">
							<img class="w-full" src="{{ asset('assets/img/card-top.jpg') }}" alt="Sunset in the mountains">
						</a>
						<div class="px-0 py-3">
							<a href="#" class="font-normal font-serif text-2xl mb-2 leading-tight inline-block no-underline hover:no-underline">Laravel API Authentication for Social Networks — OAuth2 Social Grant</a>
						</div>
						
						<div class="flex w-full items-center font-sans px-0 pt-0 pb-0">
							<a href="#">
								<img class="w-10 h-10 rounded-full mr-1" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar of Author">
							</a>
							<div class="flex-1 px-1">
								<a href="#" class="font-normal text-sm md:text-sm leading-none mb-1 inline-block hover:underline">Henry Paulson</a>
								<p class="text-xs md:text-xs font-normal text-gray-600 tracking-wider">AUg 27, 2019</p>
							</div>
						</div>
					</div>
				</div>

				<div class="w-full md:w-1/3 md:pl-4 md:pr-0 pb-12">
					<div class="max-w-sm overflow-hidden">
						<a href="#">
							<img class="w-full" src="{{ asset('assets/img/card-top.jpg') }}" alt="Sunset in the mountains">
						</a>
						<div class="px-0 py-3">
							<a href="#" class="font-normal font-serif text-2xl mb-2 leading-tight inline-block no-underline hover:no-underline">Laravel: View Composer Grant</a>
						</div>
						
						<div class="flex w-full items-center font-sans px-0 pt-0 pb-0">
							<a href="#">
								<img class="w-10 h-10 rounded-full mr-1" src="{{ asset('assets/img/avatar.png') }}" alt="Avatar of Author">
							</a>
							<div class="flex-1 px-1">
								<a href="#" class="font-normal text-sm md:text-sm leading-none mb-1 inline-block hover:underline">Jose Bloomberg</a>
								<p class="text-xs md:text-xs font-normal text-gray-600 tracking-wider">Jul 8, 2019</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="bg-white px-5 border-t border-gray-300">
		<div class="container max-w-5xl mx-auto md:flex py-6">

			{{-- <div class="w-full mx-auto flex flex-wrap">
				<div class="flex w-full md:w-1/2 ">
					<div class="px-8">
						<h3 class="font-bold text-gray-900">About</h3>
						<p class="py-4 text-gray-600 text-sm">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus
							commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia.
						</p>
					</div>
				</div>

				<div class="flex w-full md:w-1/2">
					<div class="px-8">
						<h3 class="font-bold text-gray-900">Social</h3>
						<p class="py-4 text-gray-600 text-sm">
							<a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Twitter</a>
							<a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-1" href="#">Facebook</a>
						</p>
					</div>
				</div>
			</div> --}}

			<div class="w-full md:w-1/2">
				<p class="font-normal text-sm tracking-wide">&copy; 2019 <a href="#" class="no-underline hover:no-underline text-purple-700 font-bold">Larablog</a></p>
			</div>

			<div class="w-full md:w-1/2 text-right ">
				Follow us on
			</div>

		</div>
	</footer>

	<script>
		/* Progress bar */
	//Source: https://alligator.io/js/progress-bar-javascript-css-variables/
	var h = document.documentElement,
		  b = document.body,
		  st = 'scrollTop',
		  sh = 'scrollHeight',
		  progress = document.querySelector('#progress'),
		  scroll;
	var scrollpos = window.scrollY;
	var header = document.getElementById("header");
	var navcontent = document.getElementById("nav-content");

	document.addEventListener('scroll', function() {

	/*Refresh scroll % width*/
	scroll = (h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100;
	progress.style.setProperty('--scroll', scroll + '%');

	/*Apply classes for slide in bar*/
	scrollpos = window.scrollY;

    if(scrollpos > 10){
      header.classList.add("bg-white");
	  header.classList.add("shadow");
	  navcontent.classList.remove("bg-gray-100");
	  navcontent.classList.add("bg-white");
    }
    else {
	  header.classList.remove("bg-white");
	  header.classList.remove("shadow");
	  navcontent.classList.remove("bg-white");
	  navcontent.classList.add("bg-gray-100");
	  
    }

	});


	//Javascript to toggle the menu
	document.getElementById('nav-toggle').onclick = function(){
		document.getElementById("nav-content").classList.toggle("hidden");
	}
	
	
	</script>

</body>

</html>