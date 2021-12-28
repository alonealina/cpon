@foreach ($scenes as $scene)
<input type="checkbox" class="check_box" id="scene_{{ $scene->id }}" name="scenes[{{ $scene->id }}]"
@if(old('scenes.' . $scene->id) == 'on' || isset($filter_scenes[$scene->id])) checked @endif />
<label class="label" for="scene_{{ $scene->id }}">{{ $scene->name }}</label>
@endforeach