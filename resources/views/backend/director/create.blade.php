<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Director</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createDirectorForm" action="{{ route('director.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter director's name" required>
                    </div>
                    <div class="form-group">
                        <label for="biography">Biography</label>
                        <textarea class="form-control" id="biography" name="biography" rows="4" placeholder="Enter director's biography" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Movie</label>
                            <select class="select2" multiple="multiple" data-placeholder="Select a Movie" style="width: 100%;">
                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    <!-- Image Preview Section -->
                    <div class="form-group">
                        <label for="edit_profile_photo">Profile Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit_profile_photo" name="profile_photo"
                                accept="image/*">

                            <label class="custom-file-label" for="edit_profile_photo">Choose file</label>
                        </div>
                        <br>
                        <img id="current_photo" src="" width="100" class="rounded mt-2" alt="Actor Profile">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add script for image preview and filename -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('#modal-lg #profile_photo');
    const imagePreview = document.querySelector('#imagePreview');
    const previewImg = document.querySelector('#previewImg');
    const imageName = document.querySelector('#imageName');

    // Event listener for file input change
    fileInput.addEventListener('change', function(e) {
      const file = e.target.files[0];

      if (file) {
        // Show the image preview
        const reader = new FileReader();

        reader.onload = function(event) {
          previewImg.src = event.target.result;
          imagePreview.style.display = 'block'; // Show the image preview section
        }

        reader.readAsDataURL(file);

        // Display the name of the file
        imageName.textContent = `Selected file: ${file.name}`;
      } else {
        imagePreview.style.display = 'none'; // Hide the preview section if no file is selected
      }
    });
  });
</script>
