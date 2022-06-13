@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                       <h4>Token Code</h4>

                    </div>
                    <div>
                       <div class="inline-block-center" >
                           <form action="{{route('tokenpost')}}" method="POST">
                               @csrf
                               <div class="form-group stylephoneact">

                                   <label class="col-form-label" for="token">Token : </label>
                                   <input type="text" class="form-control @error('token') is-invalid @enderror
                                   styleinput" name="token" placeholder="Enter Your Active Code">
                                   @error('token')
                                   <span class="invalid-feedback">
                                       <strong>{{$message}}</strong>
                                   </span>
                                   @enderror
                                   <div class="form-group stylebuttowfact">

                                       <button class="btn btn-success">Validate</button>

                                   </div>

                               </div>
                           </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
