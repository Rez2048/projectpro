@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">

                        <ul class="nav nav-pills card-header-pills">

                            <li class="nav-item">
                                <a  class="nav-link {{request()->is('profile')? 'active' : ''}}"  href="{{route('profile')}}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link {{request()->is('profile/towfactorauth')? 'active' : ''}}" href="{{route('towfactorauth')}}">TowFactorAuth</a>
                            </li>

                        </ul>

                    </div>
                    <div>
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
@endsection
