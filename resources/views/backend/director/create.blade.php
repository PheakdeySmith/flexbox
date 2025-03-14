<div class="modal fade" id="createDirectorModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white"><i class="fas fa-plus-circle mr-2"></i>Create Director</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createDirectorForm" action="{{ route('director.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user mr-1"></i>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter director's name" required>
                                <small class="form-text text-muted">Enter the full name of the director</small>
                            </div>

                            <div class="form-group">
                                <label for="biography"><i class="fas fa-book mr-1"></i>Biography <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="biography" name="biography" rows="5" placeholder="Enter director's biography" required></textarea>
                                <small class="form-text text-muted">Provide a detailed biography of the director</small>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-film mr-1"></i>Associated Movies</label>
                                <select class="select2" name="movies[]" multiple="multiple" data-placeholder="Select movies" style="width: 100%;">
                                    @foreach($movies as $movie)
                                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Select movies directed by this person (optional)</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="profile_photo"><i class="fas fa-image mr-1"></i>Profile Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profile_photo" name="profile_photo" accept="image/*">
                                    <label class="custom-file-label" for="profile_photo">Choose file</label>
                                </div>
                                <small class="form-text text-muted">Recommended size: 300x300 pixels</small>
                            </div>

                            <div class="text-center mt-3">
                                <div class="img-preview">
                                    <img id="preview_image" src="https://via.placeholder.com/200x200?text=No+Image"
                                         class="img-fluid rounded border" alt="Profile Preview">
                                </div>
                                <small id="image_name" class="d-block mt-2 text-muted"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between bg-light">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Save Director
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap4'
        });

        // BS Custom File Input
        bsCustomFileInput.init();

        // Image preview functionality
        const fileInput = document.getElementById('profile_photo');
        const previewImg = document.getElementById('preview_image');
        const imageName = document.getElementById('image_name');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    imageName.textContent = file.name;
                }

                reader.readAsDataURL(file);
            } else {
                previewImg.src = 'https://via.placeholder.com/200x200?text=No+Image';
                imageName.textContent = '';
            }
        });

        // Reset form when modal is closed
        $('#createDirectorModal').on('hidden.bs.modal', function() {
            $('#createDirectorForm').trigger('reset');
            previewImg.src = 'https://via.placeholder.com/200x200?text=No+Image';
            imageName.textContent = '';
            $('.select2').val(null).trigger('change');
        });
    });
</script>
