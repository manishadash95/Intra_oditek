
<?php
$employee = $dbobj->getEmployeeData($eid);
?>
<style>
    #cropperModal .modal-dialog {
        max-width: 800px; /* Adjust as needed */
    }

    .img-container {
        width: 100%; /* Ensures the image takes full width of modal */
        max-height: 500px; /* Increase the height for larger images */
    }

    #imageToCrop {
        width: 100%; /* Image will fill the container */
        max-height: 100%; /* Ensures the image doesn't overflow the modal */
    }
	 .form-container {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        height: 50vh; /* Half viewport height */
    }

    .form-box {
        border: #666 1px solid; /* Box border */
        padding: 20px; /* Increased padding for a larger box */
        text-align: center; /* Center text within the box */
        width: 300px; /* Specify width for the form box */
    }
</style>




<div class="form-container">
  <form name="frmemployee" id="frmemployee" method="post" enctype="multipart/form-data" onSubmit="return masterValidation();">
      <div class="col-md-2">
          <!-- Image display section -->
          <div class="text-center" style="border:#666 1px solid; padding: 10px;">
             <img src="<?php echo strlen($employee->image) > 0 ? $employee->image : 'img/noimage.gif'; ?>" id="bigimage1" border="0" width="140" height="160">

          </div>

          <!-- Upload button (label for file input) -->
          <div class="text-center" style="margin-top: 10px;">
              <label for="file-upload" style="cursor:pointer;">
                  <img src="img/upload.png" width="40" height="40" alt="Upload" />
              </label>
          </div>

          <!-- Hidden file input -->
		  <input type="hidden" id="heid" name="heid" value="">
									<input type="hidden" id="hid" name="hid" value="">
									<input type="hidden" id="htype" name="htype" value="">
          <input type="file" id="file-upload" style="display:none;" />
        
          <input type="hidden" id="hdfileupload" name="hdfileupload" value="0">
										<input type="hidden" name="hid" id="hid" value="<?php echo $id;?>">
          <!-- Update button -->
          <div class="text-center" style="margin-top: 10px;">
              <button type="button" class="btn btn-default" name="register" 
                      onclick="checkAndAddData();" id="register">Update</button>
          </div>
      </div>

      <div class="clearfix"></div>
  </form>
</div>

<!-- Cropping Modal -->
<div id="cropperModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop your image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="imageToCrop" src="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="cropImage">Ok</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Cropper.js -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>

var cropper;
var input = document.getElementById('file-upload');
var imageToCrop = document.getElementById('imageToCrop');

// Initialize cropper and handle file upload
input.addEventListener('change', function (event) {
    if (this.files.length != 0) {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            imageToCrop.src = e.target.result;
            console.log("Image selected for cropping:", e.target.result);
            $('#cropperModal').modal('show');

            // Destroy any existing cropper instance before creating a new one
            if (cropper) {
                cropper.destroy();
            }

            // Initialize Cropper.js
            cropper = new Cropper(imageToCrop, {
                aspectRatio: 1,
                viewMode: 1
            });
        };
        reader.readAsDataURL(file);
    }
});


document.getElementById('cropImage').addEventListener('click', function () {
    var croppedCanvas = cropper.getCroppedCanvas();
    var croppedImage = croppedCanvas.toDataURL('image/jpeg');
    console.log("Cropped image data:", croppedImage);

    document.getElementById('bigimage1').src = croppedImage; // Display the cropped image

    croppedCanvas.toBlob(function (blob) {
        document.getElementById('hdfileupload').value = 1;   // Mark image as cropped
        window.croppedImageBlob = blob; // Store the cropped image blob
        console.log("Cropped image blob created.");
        $('#cropperModal').modal('hide'); // Close the modal
    });
});




function checkAndAddData() {
    var imageAdd = document.getElementById('hdfileupload').value;
    document.getElementById('loading_data').style.display = "block";

    if (imageAdd == "1" && window.croppedImageBlob) {
        var form_data = new FormData();
        form_data.append("imagefile", window.croppedImageBlob, "cropped_image.jpg");

        // Upload the cropped image
        $.ajax({
            url: 'uploadProfileFiles.php', // PHP script to handle the upload
            type: 'POST',
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                var dobj = jQuery.parseJSON(response);
                if (dobj.status == 1) {
                    // Show the uploaded image in the image display section
                    document.getElementById('bigimage1').src = dobj.filename; // Update to the new filename
                    
                    // Optionally set the image to show after uploaded
                    document.getElementById('bigimage1').style.display = "block"; //  the image is displayed
                    updateProfileImage(dobj.filename); // Optionally, update profile image in the database
                } else {
                    alert(dobj.msg);
                    document.getElementById('loading_data').style.display = "none";
                }
            },
            error: function (xhr, status, error) {
                console.error('Image upload failed:', error);
                document.getElementById('loading_data').style.display = "none";
            }
        });
    } else {
        alert("Please crop the image before updating.");
        document.getElementById('loading_data').style.display = "none";
    }
}



function updateProfileImage(filename) {
    var dataString = "action=updateProfileFilename&filename=" + filename;
     alert(dataString);
    $.ajax({
        type: "POST",
        url: "ajaxprojectemployee.php",
        data: dataString,
        cache: false,
        success: function (html) {
            var dobj = jQuery.parseJSON(html);
            if (dobj.status == 1) {
                alert("Profile updated successfully!");
                location.reload();
            } else {
                alert(dobj.msg);
            }
            document.getElementById('loading_data').style.display = "none";
        }
    });
}



 
</script>
