@foreach ($scenes as $scene)
<input type="checkbox" class="check_box" id="scene_{{ $scene->id }}" name="scenes[{{ $scene->id }}]"
@if(in_array($scene->id, $restaurant_scenes)) checked @endif />
<label class="label" for="scene_{{ $scene->id }}">{{ $scene->name }}</label>
@endforeach