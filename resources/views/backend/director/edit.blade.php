<div class="modal fade" id="editDirectorModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white"><i class="fas fa-edit mr-2"></i>Edit Director</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDirectorForm" action="{{ route('director.update', ':id') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="director_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="edit_name"><i class="fas fa-user mr-1"></i>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter director's name" required>
                                <small class="form-text text-muted">Enter the full name of the director</small>
                            </div>

                            <div class="form-group">
                                <label for="edit_biography"><i class="fas fa-book mr-1"></i>Biography</label>
                                <textarea class="form-control" id="edit_biography" name="biography" rows="5" placeholder="Enter director's biography"></textarea>
                                <small class="form-text text-muted">Provide a detailed biography of the director</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_profile_photo"><i class="fas fa-image mr-1"></i>Profile Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_profile_photo" name="profile_photo" accept="image/*">
                                    <label class="custom-file-label" for="edit_profile_photo">Choose file</label>
                                </div>
                                <small class="form-text text-muted">Leave empty to keep current image</small>
                            </div>

                            <div class="text-center mt-3">
                                <div class="img-preview">
                                    <img id="current_photo" src="" class="img-fluid rounded border" alt="Director Profile">
                                </div>
                                <small class="d-block mt-2 text-muted">Current profile photo</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between bg-light">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // BS Custom File Input
        bsCustomFileInput.init();

        // Handle modal show event
        $('#editDirectorModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const { id, name, biography, profilePhoto } = button.data();

            const modal = $(this);

            // Update the form action URL
            modal.find('#editDirectorForm').attr('action', `/backend/director/${id}`);
            modal.find('#edit_id').val(id);
            modal.find('#edit_name').val(name);
            modal.find('#edit_biography').val(biography);

            // Reset the file input
            modal.find('#edit_profile_photo').val('');
            $('.custom-file-label').text('Choose file');

            // Set profile photo preview
            const preview = modal.find('#current_photo');

            if (profilePhoto) {
                // Check if it's an external URL or a local storage path
                if (profilePhoto.startsWith('http://') || profilePhoto.startsWith('https://')) {
                    preview.attr('src', profilePhoto);
                } else {
                    preview.attr('src', `/storage/${profilePhoto}`);
                }
            } else {
                preview.attr('src', 'https://via.placeholder.com/200x200?text=No+Image');
            }
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
            }
        });
    });
</script>
