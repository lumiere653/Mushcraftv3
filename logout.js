
document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const confirmLogout = confirm("Are you sure you want to log out?");
    if (confirmLogout) {
        window.location.href = "auth/logout.php";
    }
});
