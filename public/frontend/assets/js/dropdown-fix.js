// Dropdown fix script
document.addEventListener('DOMContentLoaded', function() {
    // Select all dropdown toggles
    const dropdownToggles = document.querySelectorAll('.nav-link.dropdown-toggle');

    // Function to close all dropdowns
    function closeAllDropdowns() {
        dropdownToggles.forEach(function(toggle) {
            toggle.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');

            const dropdownMenu = toggle.nextElementSibling;
            if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // Add click event listeners to each dropdown toggle
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Check if this dropdown is already open
            const isCurrentlyOpen = this.classList.contains('show');

            // Close all dropdowns first
            closeAllDropdowns();

            // If the clicked dropdown wasn't open before, open it now
            if (!isCurrentlyOpen) {
                // Toggle the 'show' class on the toggle element
                this.classList.add('show');

                // Toggle the 'show' class on the dropdown menu
                const dropdownMenu = this.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                    dropdownMenu.classList.add('show');
                }

                // Set aria-expanded attribute
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Function to close dropdown when clicking outside
    function closeDropdown(e) {
        // If the click doesn't contain any of the dropdown toggles, close all dropdowns
        let clickedInsideDropdown = false;

        dropdownToggles.forEach(function(toggle) {
            if (toggle.contains(e.target) || (toggle.nextElementSibling && toggle.nextElementSibling.contains(e.target))) {
                clickedInsideDropdown = true;
            }
        });

        if (!clickedInsideDropdown) {
            closeAllDropdowns();
        }
    }

    // Add a click event listener to the document to close dropdowns when clicking outside
    document.addEventListener('click', closeDropdown);

    // Log for debugging
    console.log('Dropdown fix script loaded. Found ' + dropdownToggles.length + ' dropdown toggles.');
});
