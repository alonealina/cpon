@foreach ($commitments as $commitment)
<input type="checkbox" class="check_box" id="commitment_{{ $commitment->id }}" name="commitments[{{ $commitment->id }}]"/>
<label class="label" for="commitment_{{ $commitment->id }}">{{ $commitment->name }}</label>
@endforeach