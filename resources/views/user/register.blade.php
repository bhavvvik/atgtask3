<!-- @extends('user/loginlayout')
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
@foreach($errors->all as $e)
<li>{{$e}}</li>
@endforeach -->

<!-- @endsection  -->

<html>

<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style type="text/css">
        body,
        td,
        th {
            color: #000000;
        }

        body {
            background-color: #F0F0F0;
        }

        .style1 {
            font-family: arial, helvetica, sans-serif;
            font-size: 14px;
            padding: 12px;
            line-height: 25px;
            border-radius: 4px;
            text-decoration: none;
        }

        .style2 {
            font-family: arial, helvetica, sans-serif;
            font-size: 17px;
            padding: 12px;
            line-height: 25px;
            border-radius: 4px;
            text-decoration: none;

        }
    </style>
</head>

<body>
    <div class="container">
        <table width="100%" height="100%" border="0" cellspacing="0" align="center">
            <tr>
                <td align="center" valign="middle">
                    <table class="table-bordered" width="350" border="0" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
                        <form action="{{route('regauth')}}" name="frm_reg" id="frm_reg" method="POST">
                            @csrf
                            <tr>
                                <td height="25" colspan="2" align="left" valign="middle" bgcolor="#FF9900" class="style2">
                                    <div align="center">
                                        <strong>Register</strong>
                                    </div>

                                </td>
                            </tr>

                            <tr>

                                <div id="err" style="color: red">


                                </div>

                            </tr>
                            <tr>
                                <td width="118" align="left" valign="middle" class="style1">name</td>
                                <td width="118" align="left" valign="middle" class="style1">
                                    <input type="text" class="form-control" size="10px" id="name" placeholder="name" name="name">
                                    @error('name')
                                    {{$message}}
                                    @enderror
                                </td>

                            </tr>

                            <tr>
                                <td width="118" align="left" valign="middle" class="style1">email</td>
                                <td width="118" align="left" valign="middle" class="style1">
                                    <input type="email" class="form-control" size="10px" id="email" placeholder="email" name="email">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </td>

                            </tr>

                            <tr>
                                <td width="118" align="left" valign="middle" class="style1">Password</td>
                                <td width="118" align="left" valign="middle" class="style1">
                                    <input type="password" class="form-control" size="10px" id="password" placeholder="password" name="password">
                                    @error('password')
                                    {{$message}}
                                    @enderror
                                </td>
                                <!-- @if($errors->any())
                                {{ implode('', $errors->all('<div>:message</div>')) }}
                                @endif -->
                            </tr>



                            <tr>

                                <td colspan="2" align="right" valign="middle" class="style1">
                                    <div style="padding-right: 193px;">
                                        already register?<a href="{{url('login')}} ">Login</a>

                                    </div>

                                    <button type="submit" class="btn btn-primary">Register</button>

                                </td>



                            </tr>

                        </form>
                    </table>

                </td>


            </tr>


        </table>
    </div>
</body>

</html>