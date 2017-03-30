@extends('layouts.principal')

@section('contenido')

<div class="banner">
	<img src="{{asset('img/banner1.jpg')}}" alt="">
</div>

<div class="col-sm-12">
	<article>
	<section class="col-sm-4" style="text-align: center;">

		<h2>Gana un certificaco valioso</h2>
		
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, ipsam, dolorem. Dolore quod, ad, consequuntur dolorum quasi voluptatibus aliquam perferendis magni cupiditate repellat ipsum nihil amet facere repellendus sapiente quo.</p>
	</section>

	<section class="col-sm-4" style="text-align: center;">
		<h2>Certificados Profesionales</h2>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, ipsam, dolorem. Dolore quod, ad, consequuntur dolorum quasi voluptatibus aliquam perferendis magni cupiditate repellat ipsum nihil amet facere repellendus sapiente quo.</p>
	</section>

	<div class="col-sm-4" style="text-align: center;">
		<h2>Respaldado</h2>
		<img src="{{asset('img/unalogo.png')}}" style="width: 50%; margin-left: auto; margin-right: auto;" />
		
	</div>
</article>


@endsection