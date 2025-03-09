<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="createUserForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter user's name" required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter user's email" required>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter user's password" required>
                    </div>

                    <!-- Profile Image Section -->
                    <div class="form-group">
                        <label for="user_profile">Profile Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="user_profile" name="user_profile" accept="image/*">
                            <label class="custom-file-label" for="user_profile">Choose file</label>
                        </div>
                        <br>
                        <img id="current_photo" src="" width="100" class="rounded mt-2" alt="Profile Photo">
                    </div>

                    <!-- Created At Field (auto-generated) -->
                    <div class="form-group">
                        <label for="created_at">Created At</label>
                        <input type="text" class="form-control" id="created_at" name="created_at" value="{{ now() }}" readonly>
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
      const fileInput = document.querySelector('#modal-lg #user_profile');
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
