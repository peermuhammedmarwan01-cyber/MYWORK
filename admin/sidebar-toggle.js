/**
 * Admin Sidebar Toggle Script
 * Handles mobile sidebar open/close functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    // Toggle sidebar on button click
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            sidebarOverlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
        });
    }

    // Close sidebar when overlay is clicked
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            sidebarOverlay.style.display = 'none';
        });
    }

    // Close sidebar when a link is clicked
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Don't close if link opens in new tab
            if (!link.target || link.target !== '_blank') {
                sidebar.classList.remove('active');
                sidebarOverlay.style.display = 'none';
            }
        });
    });

    // Close sidebar on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            sidebar.classList.remove('active');
            sidebarOverlay.style.display = 'none';
        }
    });

    // Close sidebar when window is resized to larger screen
    window.addEventListener('resize', function() {
        if (window.innerWidth > 600) {
            sidebar.classList.remove('active');
            sidebarOverlay.style.display = 'none';
        }
    });
});
