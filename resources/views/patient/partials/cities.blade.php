<option value="">--Select--</option>
@foreach ($cities as $city)
    <option value="{{ $city->city }}">{{ $city->city }}</option>    
@endforeach