<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editUserForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" id="editName" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" id="editEmail" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input type="password" id="editPassword" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editRole">Role</label>
                        <select id="editRole" name="role" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" id="editRole">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editProfilePhoto">Profile Image</label>
                        <input type="file" id="editProfilePhoto" name="user_profile" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="currentProfilePhoto">Current Profile Image</label>
                        <div id="currentProfilePhoto">
                            <img src="" id="editProfileImage" width="100" alt="Current Profile Photo">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit button event listener
        const editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Get the user data from data attributes
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userEmail = this.getAttribute('data-email');
                const userProfilePhoto = this.getAttribute('data-profile-photo');
                const formAction = this.getAttribute('data-action');
                const userRole = this.getAttribute('data-role');
                // Set the form action URL
                document.getElementById('editUserForm').action = formAction;

                // Populate the input fields
                document.getElementById('editName').value = userName;
                document.getElementById('editEmail').value = userEmail;
                document.getElementById('editPassword').value = '';
                document.getElementById('editRole').value = userRole;
                // Password can be left blank
                // Show the current profile image
                if (userProfilePhoto) {
                    document.getElementById('editProfileImage').src =
                        `/storage/${userProfilePhoto}`;
                } else {
                    document.getElementById('editProfileImage').src =
                        '/images/default-avatar.png'; // Placeholder image
                }
            });
        });

        // Profile photo preview
        document.getElementById('editProfilePhoto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('editProfileImage').src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById('editProfileImage').src =
                    '/images/default-avatar.png'; // Default placeholder
            }
        });
    });
</script>
