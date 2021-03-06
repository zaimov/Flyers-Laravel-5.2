@extends('layout')

@section('content')

	<div class="row">	
		<div class="col-md-4">
			<h1>{{ $flyer->street }}</h1>
			<h2>{{ $flyer->price }}</h2>

			<hr>

			<div class="description">
				{!! nl2br($flyer->description) !!}
			</div>
		</div>

		<div class="col-md-8 gallery">
			@foreach ($flyer->photos->chunk(4) as $set)
				<div class="row">
					@foreach ($set as $photo)
						<div class="col-md-3 gallery__image">
							<form method="POST" action="/fls/{{ $photo->id }}">
								{!! csrf_field() !!}

								<input type="hidden" name="_method" value="DELETE"></input>						
								<button type="submit">Delete</button>		
							</form>

							<img src="/{{ $photo->thumbnail_path }}" alt="">
						</div>
					@endforeach
				</div>
			@endforeach

			<hr>

			<form id="addPhotosForm" action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" 
				method="POST" 
				class="dropzone">
					{{ csrf_field() }}
   			</form>
		</div>
	</div>
@stop

@section('scripts.footer')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
	<script type="text/javascript">
		Dropzone.options.addPhotosForm = {
			paramName: 'photo',
			maxFilesize: 3,
			acceptedFiles: '.jpg, .jpeg, .png'
		}
	</script>
@stop