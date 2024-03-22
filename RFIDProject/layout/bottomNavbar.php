<div class="navbar">
    <a href="#" class="nav-item" id="user-icon"><img src="../icons/user.png" alt=""></a>
    <a href="../pages/homepage.php" class="nav-item" id="dashboard-icon"><img src="../icons/home.png" alt=""></a>
    <a href="#" class="nav-item" id="time-icon"><img src="../icons/clock.png" alt=""></a>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(item => {
        item.addEventListener('click', function () {
            navItems.forEach(navItem => navItem.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>