<a href="{{user/dashboard}}">TODO LIST</a>
<div class="row mt-3">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto ">

            <div class="card shadow">
                

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
                            <label for="task_title"> Task  </label>
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



<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $("#saveBtn").click(function() {
            var formData = $("#taskForm").serialize();
            $.ajax({
                    type    :   "POST",
                    url     :   "api/todo/add",
                    data    :   Data,
                    
                    success: function(res) { 
                        if(res.status == "success") {
                            $("#result").html("<div class='alert alert-success'>" + res.message + "</div>");
                        }

                        else if(res.status == "failed") {
                            $("#result").html("<div class='alert alert-danger'>" + res.message + "</div>");
                        }
                    }                   
            });
        });        
    });
</script>


