<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Actor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editActorForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="actor_id">
                <div class="modal-body">
                    <!-- Actor Name -->
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Enter actor name" required>
                    </div>
                    <!-- Biography -->
                    <div class="form-group">
                        <label for="edit_biography">Biography</label>
                        <textarea class="form-control" id="edit_biography" name="biography" rows="4" placeholder="Enter actor biography"
                            required></textarea>
                    </div>
                    <!-- Profile Photo -->
                    <div class="form-group">
                        <label for="edit_profile_photo">Profile Photo</label>
                        <input type="file" class="form-control-file" id="edit_profile_photo" name="profile_photo">
                        <br>
                        <img id="current_photo" src="" width="100" class="rounded mt-2" alt="Actor Profile">
                    </div>
                    <!-- Date of Birth -->
                    <div class="form-group">
                        <label for="edit_dob">Date of Birth</label>
                        <input type="date" class="form-control" id="edit_dob" name="birth_date" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id = button.data('id');
            const name = button.data('name');
            const biography = button.data('biography');
            const profilePhoto = button.data('profile-photo');
            const dob = button.data('birth_date'); // Use 'dob' to store the birth date

            const modal = $(this);

            // Update form action URL
            modal.find('#editActorForm').attr('action', `/actor/${id}`);

            // Set form values
            modal.find('#edit_id').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_biography').val(biography);
            console.log(dob);
            modal.find('#edit_dob').val(dob);

            // Set profile photo preview
            if (profilePhoto) {
                modal.find('#current_photo').attr('src', `/uploads/actors/${profilePhoto}`);
            } else {
                modal.find('#current_photo').attr('src', 'https://via.placeholder.com/100');
            }
        });
    });
</script>
