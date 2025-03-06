<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Actor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createGenreForm" action="{{ route('actor.store') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter actor's name" required>
                    </div>
                    <div class="form-group">
                        <label for="biography">Biography</label>
                        <input type="text" class="form-control" id="biography" name="biography"
                            placeholder="Enter actor's biography " required>
                    </div>
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

                    <div class="form-group">
                        <label for="birth_date">Date of Birth</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date"
                            placeholder="Enter actor's date of birth " required>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Add slug generation script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.querySelector('#modal-lg #name');
        const slugInput = document.querySelector('#modal-lg #slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('keyup', function() {
                // Generate slug from name: lowercase and replace spaces with hyphens
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/[^\w\-]+/g, '') // Remove all non-word characters
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, ''); // Trim - from end of text
            });
        }
    });
</script>
<script>
    document.getElementById('edit_profile_photo').addEventListener('change', function(event) {
        let file = event.target.files[0]; // Get the selected file
        let label = event.target.nextElementSibling; // Get the label element

        if (file) {
            label.textContent = file.name; // Update label with file name

            // Show preview
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('current_photo').src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            label.textContent = "Choose file"; // Reset label if no file selected
        }
    });
</script>
