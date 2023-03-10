<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('/ijaboCropTools/ijaboCropTool.min.css') }}">
    <script src="{{ asset('/ijaboCropTools/ijaboCropTool.min.js') }}"></script> 
    <script src="{{ asset('/ijaboCropTools/jquery-1.7.1.min.js') }}"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>
<body>
    
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-auto">
          <span class="avatar avatar-md" style="background-image: url()"></span>
        </div>
        <div class="col-md-6">
          <h2 class="page-title">sdsdb</h2>
          <div class="page-subtitle">
            <div class="row">
              <div class="col-auto">
                <!-- Download SVG icon from http://tabler-icons.io/i/building-skyscraper -->
                <!-- SVG icon code -->
                <a href="#" class="text-reset">hdh</a>
              </div>
            
            </div>
          </div>
        </div>
        <div class="col-auto  d-md-flex">
          <input type="file" name="file" id="changeAuthorPictureFile" class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
          <a href="#" class="btn btn-primary" onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
            <!-- SVG icon code -->
            Change picture
          </a>
        </div>
      </div>
    </div>
</div>
<script>
    $('#changeAuthorPictureFile').ijaboCropTool({
          preview : '',
          setRatio:1,
          allowedExtensions: ['jpg', 'jpeg','png'],
          buttonsText:['CROP','QUIT'],
          buttonsColor:['#30bf7d','#ee5155', -15],
          processUrl:'{{ route("author.change-profile-picture") }}',
          withCSRF:['_token','{{ csrf_token() }}'],
          onSuccess:function(message, element, status){
            //  alert(message);
            Livewire.emit('updateAuthorProfileHeader');
            Livewire.emit('updateTopHeader');
            toastr.success(message);
          },
          onError:function(message, element, status){
            // alert(message);
            toastr.error(message);
          }
    });
  </script>
</body>
</html>