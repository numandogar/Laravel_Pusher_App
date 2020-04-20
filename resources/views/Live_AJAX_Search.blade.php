<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="_token" content="{{csrf_token()}}" />
        <title>My Personal List</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css"/>
    </head>
    <body>
      <div class="container">
         <div class="alert alert-success" style="display:none"></div>
         <form action="{{route('grocery.store')}}" method="post" id="myForm" enctype="multipart/form-data">
			{{csrf_field()}}
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="city">City:</label>
              <input type="text" class="form-control" name="city" id="city">
            </div>
            <div class="form-group">
               <label for="phone">Phone #:</label>
               <input type="text" class="form-control" name="phone" id="phone">
             </div>
             <div class="form-group">
                <label for="zip">Zip Code:</label>
                <input type="text" class="form-control" name="zip" id="zip">
              </div>
            <button class="btn btn-primary" type="submit" id="ajaxSubmit">Submit</button>
          </form>
      </div>
      <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
      </script>
      <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/grocery/post') }}",
                  method: 'post',
                  data: {
                     name: jQuery('#name').val(),
                     city: jQuery('#city').val(),
                     phone: jQuery('#phone').val(),
                     zip: jQuery('#zip').val()
                  },
                  success: function(result){
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success);
                  }});
               });
            });
      </script>
    </body>
</html>