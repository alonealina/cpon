@foreach ($commitments as $commitment)
<input type="checkbox" class="check_box" id="commitment_{{ $commitment->id }}" name="commitments[{{ $commitment->id }}]"
@if(old('commitments.' . $commitment->id) == 'on') checked @endif />
<label class="label" for="commitment_{{ $commitment->id }}">{{ $commitment->name }}</label>
@endforeach