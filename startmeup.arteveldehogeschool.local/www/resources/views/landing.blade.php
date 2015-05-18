@extends('layouts.frontoffice')

@section('content')
<body>
	<md-content class="md-padding" layout="column" layout-align="center center">
		<section class="md-whiteframe-z1" style="padding: 1em; max-width: 60em">
			<h1>StartMeUp.io</h1>
			<p>You are a born entrepreneur, but sometimes you feel like you are alone in your world? You are looking for peers? You are looking for support? You are looking for that extra trigger that keeps it exciting. Celebrations to your efforts and achievements?</p>

			<p>StartMeUp.io, a mobile buddy app will give you these little moments of support and celebration. A personal coach in your venture, it is always there and it gives you support.</p>

			<p>Based on the data you put in, you will receive feedback loops.  The more you use the app, the better it will get to know you, the better it will support you.</p>

			<h2>Co-creation – open source</h2>
			<p>The open source app is in co-creation with students, pre - and early stage starters. Once we have a solid prototype we can open it up to the community for further improvements and subject for debate.</p>

			<h2>Aim of project</h2>
			<p>The aim of this research project is to test it out among startup communities in different regions. The data can be used in research to map entrepreneurial behaviour.</p>

			<p>In addition we see it as tool that can be embedded in the curriculum of students to test their entrepreneurial skills.</p>

			<p>©2014-{{ Carbon\Carbon::now()->year }} Christel De Maeyer, Karijn Bonne &amp; Olivier Parent</p>
		</section>

		<section layout="row" layout-sm="column" layout-align="center center">
			{!! Html::linkRoute('frontoffice.home', 'Web App'    , [], ['class' => 'md-button md-default-theme']) !!}
			{!! Html::linkRoute('backoffice.home' , 'Admin'      , [], ['class' => 'md-button md-default-theme']) !!}
			{!! Html::linkRoute('styleguide.home' , 'Style Guide', [], ['class' => 'md-button md-default-theme']) !!}
		</section>
	</md-content>
</body>
@stop
