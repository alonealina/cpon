<input type="hidden" name="cards[visa]" value="0">
<input type="checkbox" class="check_box" id="visa" name="cards[visa]" value="1"
@if($cards['visa'] == 1) checked @endif />
<label class="label" for="visa">VISA</label>
<input type="hidden" name="cards[mastercard]" value="0">
<input type="checkbox" class="check_box" id="mastercard" name="cards[mastercard]" value="1"
@if($cards['mastercard'] == 1) checked @endif />
<label class="label" for="mastercard">MasterCard</label>
<input type="hidden" name="cards[jcb]" value="0">
<input type="checkbox" class="check_box" id="jcb" name="cards[jcb]" value="1"
@if($cards['jcb'] == 1) checked @endif />
<label class="label" for="jcb">JCB</label>
<input type="hidden" name="cards[diners]" value="0">
<input type="checkbox" class="check_box" id="diners" name="cards[diners]" value="1"
@if($cards['diners'] == 1) checked @endif />
<label class="label" for="diners">Diners</label>
<input type="hidden" name="cards[amex]" value="0">
<input type="checkbox" class="check_box" id="amex" name="cards[amex]" value="1"
@if($cards['amex'] == 1) checked @endif />
<label class="label" for="amex">AMEX</label>
<input type="hidden" name="cards[other]" value="0">
<input type="checkbox" class="check_box" id="other" name="cards[other]" value="1"
@if($cards['other'] == 1) checked @endif />
<label class="label" for="other">その他</label>
