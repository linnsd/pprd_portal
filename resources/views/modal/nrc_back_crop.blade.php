<!-- crop image modal -->
<div id="uploadimageModal2" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="float: left;">Crop Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-8 text-center">
                <div id="image_demo2" style="width:300px; margin-top:30px"></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary vanilla-rotate" data-deg="-90">Rotate</button>
            <button class="btn btn-success crop_nrc_back">Crop</button>            
            {{-- <button type="button" class="btn btn-default cancel_crop" data-dismiss="modal">Cancel</button>
             --}}
          </div>
      </div>
    </div>
</div>

<script>  
$(document).ready(function(){

  $image_crop3 = $('#image_demo2').croppie({
    enableExif: true,
    viewport: {
      width:300,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:320,
      height:220
    },
    enableOrientation: true
  });

$('.back_upload').on('change', function(){
    $('#nrc_back_hidden_photo').val('');
    var reader = new FileReader();
    var img = new Image();
    reader.onload = function (event) {
      img.onload = function (event) {
                var canvas = document.createElement( 'canvas' );
        var ctx = canvas.getContext( "2d" );
        var width = img.width;
        var height = img.height;
        var MAX_WIDTH = 1000;
        var MAX_HEIGHT = 1000;

        // Resize maintaining aspect ratio
        if ( width > height ) {
            if ( width > MAX_WIDTH ) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
            }
        } else {
            if ( height > MAX_HEIGHT ) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
            }
        }
        canvas.width = width;
        canvas.height = height;

        // Copy the image to the canvas and resize it.
        ctx.drawImage( img, 0, 0, width, height );

         //alert('aa');
        $image_crop3.croppie('bind', {
        url: img.src
      }).then(function(){
        console.log('jQuery bind complete');
      });
      $('form #nrc_back_preview').attr('src', event.target.result);
      $('#nrc_back_preview').removeClass('hidden');
      $('#remove_back_preview').removeClass('hidden');
      $('#nrc_back_preview').addClass('img-thumbnail');

      }
      img.src = event.target.result;

    }
    reader.readAsDataURL(this.files[0]); 
    $('#uploadimageModal2').modal('show');
  });

  $('.crop_nrc_back').click(function(event){
    $image_crop3.croppie('result', {
      url: event.target.result,
      type: 'canvas',
      size: 'original',
      format: "png", 
      quality: 1
    }).then(function(response){
          $('#uploadimageModal2').modal('hide');
          $('#nrc_back_hidden_photo').val(response);
          $('#nrc_back_preview').addClass('img-thumbnail');
          $('#nrc_back_preview').attr("src",response);
    })
  });
    $('.vanilla-rotate').on('click', function(ev) {
        $image_crop3.croppie('rotate', parseInt($(this).data('deg')));
    });
      //ksk add for remove image preview 
    $("#remove_back_preview").click(function () {     
        //$('#image_preview').removeProp('src').hide();
        //$('#uploaded_image').val('');
        $('#nrc_back_preview').attr('src','');
        $('#nrc_back_hidden_photo').val('');
        $('.back_upload').val('');          
        document.getElementById("delete_photo").value = 1;
    });
});  
</script>
