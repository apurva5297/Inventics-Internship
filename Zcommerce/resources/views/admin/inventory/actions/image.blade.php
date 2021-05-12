@if($inventory->image)
	<img src="{{ get_storage_file_url($inventory->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
@else
	<img src="{{ get_storage_file_url(optional($inventory->product->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
@endif