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
<p><a href="{{ url('user/logout') }}">Logout</a></p>                                 


<div class="row mt-3">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto ">

            <div class="card shadow">
                <h2>Add New Task</h2>

                <form method="post" id="taskForm">
                    {{csrf_field() }}

                    <div class="card-body">

                    <!-- --- Display success message ----- -->
                    @if(Session::has('success'))
                        <div class='alert alert-success'>
                            {{ Session::get('success') }}
                            @php 
                                Session::forget('success')
                            @endphp
                        </div>
                    @endif


                        <div class="form-group">
                            <label for="task_title" style="font-size:20px"> Task  </label>
                            <input type="text" class="form-control" name="task_title" id="task_title" placeholder="Task Title">
                        </div>


                    <div class="card-footer">
                        <button type="button" id="saveBtn" class="btn btn-success">Save Task</button>
                    </div>

                    <div id="result"></div>
                </form>
            </div>
        </div>
    </div>

<table class="table table-striped" style="padding-left: 500;">
     <thead class="bg-success text-white">
         <th> id </th>
         <th> Task </th>
         <th> status </th>
         <th width="10%"> Action </th>
     </thead>

     <tbody align="center" id="table__body">
         @foreach($tasks as $task)
         <tr id="task__{{ $task->id }}">
         <td> {{ $task->id }} </td>
             <td> {{ $task->task }} </td>
            
             <td ><span id="changes__{{$task->id}}" rel="{{$task->status}}"><?php
               if($task->status == 1){
                   echo "Done";
               }  else{
                   echo "Pending";
               }
             ?></span> </td>
            
             <td> 
             <input  data-id="{{$task->id}}" class="toggle-class changeStatus" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $task->status ? 'checked' : '' }}>
                    
                 <!-- <a href="" id="changeStatus" data-id="{{ $task->id }}" class="badge badge-success" {{ $task->status == 0 ? 'checked' : '' }}> Edit status  </a> </td> -->
         </tr>
         @endforeach
     </tbody>

     <tfoot>

     </tfoot>
</table>

<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        var accessToken = "<?php echo $accessToken ?>";
        $.ajaxSetup({
            headers: {
                'Authorization': "Bearer "+ accessToken
            }
        });

    //     function changetaskStatus(_this, id) {
    //         var status = $(_this).prop('checked') == true ? 1 : 0;
    //         // let _token = $('meta[name="csrf-token"]').attr('content');

    //         $.ajax({
    //             url: '{{url('api/status/change')}}',
    //             type: 'post',
    //             data: {'status': status, 'task_id': _token},
    //             success: function (result) {
    //                 // var tableBody = $("#table__html");
    //                 //         var data = (res.data || {});
    //                 //         tableBody.append('<tr><td>'+data.id+'</td><td>'+data.task+'</td><td>'+data.status+'</td><td><a href="" id="change" onclick="changetaskStatus(event.target, '+data.id+');" class="badge badge-success"> Edit status  </a> </td></td></tr>');
                            
    //             }
    //         });
    //    }
        
    $('.changeStatus').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let taskId = $(this).data("id");
        console.log(taskId);
        console.log(status);
        
        $.ajax({
            type: "put",
            dataType: "json",
            url:'{{url("api/todo/status")}}'+"/"+taskId,
            data: {'status': status},
            dataType: "json",
            success: function (res) {
                if(res.success == true) {
                    console.log("success");
                    var data = (res.data || {});
                    // var data = $.parseJSON(res.d);
                    // console.log(res.data.status);

                        if(data == "1"){
                            console.log("1");
                            document.getElementById("changes__"+taskId).textContent="Done";
                        }else{
                            console.log("0");
                            document.getElementById("changes__"+taskId).textContent="Pending";

                        }
                    }
            }
           
        });
    });
       


      $("#saveBtn").click(function() {
            var formData = $("#taskForm").serialize();
            $.ajax({
                    type    :   "POST",
                    url     :   '{{url('api/todo/add')}}',
                    data    :   formData,
                    
                    success: function(res) { 
                        if(res.success == true) {
                           var tableBody = $("#table__body");
                            var data = (res.data || {});
                            
                             tableBody.append('<tr><td>'+data.id+'</td><td>'+data.task+'</td><td>'+data.status+'</td><td><a href="" id="change" onclick="changetaskStatus(event.target, '+data.id+');" class="badge badge-success"> Edit status  </a> </td></td></tr>');
                            // window.location.replace('{{url('api/todo/tasks')}}');
                            
                        }

                        else if(res.status == "failed") {
                            $("#result").html("<div class='alert alert-danger'>" + res.message + "</div>");
                            // $("#result").html("<div class='alert alert-success'>" + res.message + "</div>");
                            window.location.replace('{{url('api/todo/tasks')}}');

                        }
                    }                   
            });
        });        
   
});
</script>
</body></html>
