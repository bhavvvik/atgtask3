 <!-- @extends('user/loginlayout')
@section('logincontainer')
<h2>Login</h2> -->
 <!-- {{ url('/login') }}  -->
 <!-- 
<form action="{{ url('api/loginauth') }}" method="post">
                            @csrf
                                
                                    <label>Email Address</label>
                                    <input type="email" name="email" placeholder="Email">
                                </br>
                                    <label>Password</label>
                                    <input  type="password" name="password" placeholder="Password">
                               </br>
                               
                                <button  type="submit">sign in</button>
                                
                              
                                    {{session('error')}}
						
</form>
<h3>For Direct Run use</h3>
<p>email:abc@abc.com </br>
password:abc</p>
@endsection -->





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
                         <form action="{{route('user.auth')}}" name="frm_login" id="frm_login" method="POST">
                             @csrf
                             <tr>
                                 <td height="25" colspan="2" align="left" valign="middle" bgcolor="#FF9900" class="style2">
                                     <div align="center">
                                         <strong>Login</strong>
                                     </div>

                                 </td>
                             </tr>

                             <tr>

                                 <div id="err" style="color: red">


                                 </div>

                             </tr>


                             <tr>
                                 <td width="118" align="left" valign="middle" class="style1">email</td>
                                 <td width="118" align="left" valign="middle" class="style1">
                                     <input type="email" class="form-control" size="10px" id="email" placeholder="email" name="email">
                                 </td>

                             </tr>

                             <tr>
                                 <td width="118" align="left" valign="middle" class="style1">Password</td>
                                 <td width="118" align="left" valign="middle" class="style1">
                                     <input type="password" class="form-control" size="10px" id="password" placeholder="password" name="password">
                                 </td>

                             </tr>



                             <tr>
                             
                                 <td colspan="2" align="right" valign="middle" class="style1">
                                 <a href="{{url('register')}} " style="padding-right: 193px;">Register</a>

                                     <button type="submit" class="btn btn-primary">Sign In</button>

                                 </td>
                                


                             </tr>

                         </form>
                     </table>

                 </td>


             </tr>


         </table>
     </div>



     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
     <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

     <script>
         function login() {
             if ($('#email').val() == "") {
                 $('#email').parent('td').addClass('has-error');
                 return false;
             } else if ($('#password').val() == "") {
                 $('#password').parent('td').addClass('has-error');
                 return false;
             } else if ($('#utype').val() == "") {
                 $('#utype').parent('td').addClass('has-error');
                 return false;
             }
             var data = $("#frm_login").serialize();

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             $.ajax({
                 type: 'POST',
                 url: '{{url('
                 api / loginauth ')}}',
                 data: data,
                 dataType: 'json',
                 success: function(response) {
                     console.log(response);

                     if (response.status == "success") {
                         localStorage.setItem('access_token', response.token);
                         // sessionStorage.setItem("access_token", response.token);
                         console.log("sucess!");

                         window.location.replace('{{url('
                             user / dashboard ')}}');
                         // $( document ).ajaxSend(function( event, jqxhr, settings ) {
                         //           jqxhr.setRequestHeader('Authorization', "Bearer " + data.token); 

                         //     });


                     } else if (response.status == "failed") {
                         $("#err").hide().html("email or Password  Incorrect. Please Check").fadeIn('slow');
                     }
                 }
             });
             console.log('clicked!');

         }
     </script>

 </body>


 </html>