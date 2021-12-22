@foreach ($commitments as $commitment)
<input type="checkbox" class="check_box" id="commitment_{{ $commitment->id }}" name="commitments[{{ $commitment->id }}]"
@if(in_array($commitment->id, $restaurant_commitments)) checked @endif />
<label class="label" for="commitment_{{ $commitment->id }}">{{ $commitment->name }}</label>
@endforeach