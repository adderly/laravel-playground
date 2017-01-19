
<ul class="list-group">
	@foreach ($users as $user)
		<li class="list-group-item" data-id="{{ $user->id }}">{{ $user->name }} -- {{ $user->email }}
			<span class="badge enabled-group">
					<input name="enabled" type="checkbox" class="enabled"
						@if($user->enabled)
							checked
						@endif
						  data-size="mini" />
			</span>
			<span class="badge glyphicon glyphicon-minus-sign delete" >-</span>
		</li>
	@endforeach
</ul>
