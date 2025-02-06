<?php

 ini_set("display_errors", 1);
    error_reporting(E_ALL);
	

   
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
  
      <div class="col-md-2">
          <!-- Image display section -->
          <div class="text-center" style="border:#666 1px solid; padding: 10px;">
          <img src="img/male.jpg" id="bigimage2_2" name="bigimage2_2" border="0" width="140" height="160" style="border:#666 1px solid">

          </div>

          <!-- Upload button (label for file input) -->
          <div class="text-center" style="margin-top: 10px;">
              <label for="file-upload" style="cursor:pointer;">
                  <img src="img/upload.png" width="40" height="40" alt="Upload" />
              </label>
          </div>

          <!-- Hidden file input -->
        
  <input type="file" id="file-upload" style="display:none;" />
      
          <input type="hidden" id="hdfileupload" name="hdfileupload" value="0">
          <!-- Update button -->
          <div class="col-lg-12" style="padding-top:50px;">
									<div class="bpaddingdiv1 text-center">
									 <input type="button" class="btn btn-green btn" value="Update" onClick="checkAndAddData();">
									</div>
									</div>
      </div>

      <div class="clearfix"></div>
  
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
    if (this.files.length !== 0) {
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

    document.getElementById('bigimage2_2').src = croppedImage; // Display the cropped image

    croppedCanvas.toBlob(function (blob) {
        document.getElementById('hdfileupload').value = "1";   // Mark image as cropped
        window.croppedImageBlob = blob; // Store the cropped image blob
        console.log("Cropped image blob created.");
        $('#cropperModal').modal('hide'); // Close the modal
    });
});

// Handle Update button click
function checkAndAddData() {
    console.log("checkAndAddData called");

    var heid = document.getElementById('heid').value;
    var imageAdd = document.getElementById('hdfileupload').value;

    document.getElementById('loading_data').style.display = "block";

    if (imageAdd === "1" && window.croppedImageBlob) {
        console.log("Image is ready for upload");

        var form_data = new FormData();
        form_data.append("imagefile", window.croppedImageBlob, "cropped_image.jpg");
        form_data.append("heid", heid);

        $.ajax({
            type: "POST",
            url: "uploadProfileFilesimg.php",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            success: function (html) {
                var dobj = jQuery.parseJSON(html);
                console.log("Image upload response:", dobj);
                if (dobj.status == 1) {
                    updateImageInfo(dobj.filename); // Pass the correct filename
                    alert(dobj.msg);
                } else {
                    alert("Image upload failed: " + dobj.msg);
                }
                document.getElementById('loading_data').style.display = "none";
                location.reload();
            },
            error: function () {
                alert("Error uploading the image.");
                document.getElementById('loading_data').style.display = "none";
            },
        });
    } else {
        alert("Please crop the image before updating.");
        document.getElementById('loading_data').style.display = "none";
    }
}
Please use the credentials below to start a session. TeamViewer ID: 1 155 167 606 Password: rppxvdg3 123456
function updateImageInfo(filename) {
    var emp_name = document.getElementById('emp_name').value;
    var heid = document.getElementById('heid').value;

    console.log("Updating Image for Employee ID:", heid);

    if (confirm("Are you sure you want to update the Image Info of \"" + emp_name + "\"?")) {
        var dataString = "act=updateImageInfo&filename=" + filename + "&";
        dataString += $("#editdata").serialize();
        $.ajax({
            type: "POST",
            url: "ajaxhremployee.php",
            data: dataString,
            cache: false,
            success: function (response) {
               //console.log(" response from PHP:", response);

                var dobj = JSON.parse(response);
                //console.log("Parsed response data:", dobj);

                if (dobj.status === 1) {
                    alert("Profile updated successfully!");
                } else {
                    //alert("Failed to update: " + dobj.msg);
                }
                document.getElementById('loading_data').style.display = "none";
            },
            error: function () {
               // alert("Error updating image info.");
                document.getElementById('loading_data').style.display = "none";
            }
        });
    }
}




</script>