@extends('user.profile.layout')

@section('main')
<h4>TowFactorAuth</h4>
    <hr>
  @include('layouts.error')
    <form action="#" method="POST">
        @csrf
        <div class="form-group styleformtowfact">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
               @foreach(config('towfactor.types') as $key=>$name)

                <option value="{{$key}}"
                  {{ old('type')==$key||auth()->user()->two_factor_type == $key ? 'selected' : '' }}>
                {{$name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group styleformtowfact">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="phone_num"
            value=" {{old('phone') ?? auth()->user()->phone_number}}"
            >
        </div>

        <div class="form-group stylebuttowfact">
            <button class="btn btn-primary">Update</button>
        </div>


    </form>
@endsection

