<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Director</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDirectorForm" action="{{ route('director.update', ':id') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="director_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name"
                            placeholder="Enter director's name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_biography">Biography</label>
                        <textarea class="form-control" id="edit_biography" name="biography" placeholder="Enter director's biography"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_profile_photo">Profile Photo</label>
                        <input type="file" class="form-control-file" id="edit_profile_photo" name="profile_photo">
                        <br>
                        <img id="current_photo" src="" width="100" class="rounded mt-2" alt="Director Profile">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#editModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const { id, name, biography, profilePhoto } = button.data();

            const modal = $(this);

            // Update the form action URL
            modal.find('#editDirectorForm').attr('action', `/backend/director/${id}`);
            modal.find('#edit_id').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_biography').val(biography);

            // Set profile photo preview
            const preview = modal.find('#current_photo');
            preview.attr('src', profilePhoto ? `/storage/${profilePhoto}` : 'https://via.placeholder.com/100');
        });

        // Preview selected profile photo
        document.getElementById('edit_profile_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('current_photo').src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById('current_photo').src = 'https://via.placeholder.com/100';
            }
        });
    });
</script>
