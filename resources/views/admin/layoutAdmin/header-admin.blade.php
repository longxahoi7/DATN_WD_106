<header class="custom-header" style="background: #f5f5f5; padding: 0 16px;">
    <button class="menu-toggle" onclick="toggleSidebar()"
        style="font-size: 16px; border: none; background: none; cursor: pointer;">
        <i class="icon-menu"></i>
    </button>
    <h1 style="display: inline-block; margin-left: 16px; font-size: 18px;">Admin Panel</h1>
</header>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.custom-sider');
    sidebar.classList.toggle('collapsed');
}
</script>