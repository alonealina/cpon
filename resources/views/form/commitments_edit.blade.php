@foreach ($commitments as $commitment)
<input type="checkbox" class="check_box" id="commitment_{{ $commitment->id }}" name="commitments[{{ $commitment->id }}]"
@if(old('commitments.' . $commitment->id) == 'on') checked 
@elseif(empty(old('commitments')) && in_array($commitment->id, $restaurant_commitments)) checked @endif />
<label class="label" for="commitment_{{ $commitment->id }}">{{ $commitment->name }}</label>
@endforeach