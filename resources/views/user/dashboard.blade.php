<html>
<head>
<style>body{
  font-family: 'Open Sans', sans-serif;
  background:#B78E80;
  margin: 0 auto 0 auto;  
  width:100%; 
  text-align:center;
  margin: 20px 0px 20px 0px;   
}</style>
</head>
<body>
<h1>welcome<h1>
<h1>  {{ auth()->user()->name }}<h1>
<!-- <p><a href="{{ url('user/logout') }}">Logout</a></p>                                  -->
SHOW TODO LIST
<a href="{{route('tasks.get')}}">LIST</a>
</body>
</html>