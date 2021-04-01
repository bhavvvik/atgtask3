@extends('user/loginlayout')
@section('logincontainer')
<h2>Register</h2>
<form action="{{route('regauth')}}" method="post">
                            @csrf
                            <label>Name</label>
                                    <input type="text" name="name" placeholder="name">
                                    @error('name')
                                    {{$message}}
                                    @enderror 
                                </br>
                                    <label>Email Address</label>
                                    <input type="email" name="email" placeholder="Email">
                                    @error('email')
                                    {{$message}}
                                    @enderror 
                                </br>
                                    <label>Password</label>
                                    <input  type="password" name="password" placeholder="Password">
                                    @error('password')
                                    {{$message}}
                                    @enderror 
                               </br>
                               
                                <button  type="submit">sign in</button>
                                
                              
                                    {{session('error')}}
						
</form>
<!-- @foreach($errors->all as $e)
<li>{{$e}}</li>
@endforeach -->

@endsection