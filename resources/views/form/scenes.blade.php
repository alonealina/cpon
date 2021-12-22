@foreach ($scenes as $scene)
<input type="checkbox" class="check_box" id="scene_{{ $scene->id }}" name="scenes[{{ $scene->id }}]"/>
<label class="label" for="scene_{{ $scene->id }}">{{ $scene->name }}</label>
@endforeach