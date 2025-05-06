document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("sidebar-custom");
    const toggleBtn = document.getElementById("sidebar-custom-toggle");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function() {
            sidebar.classList.toggle("collapsed");
            localStorage.setItem("sidebar-collapsed", sidebar.classList.contains("collapsed") ? "1" : "0");
        });
    }

    // بازگرداندن وضعیت قبلی سایدبار (باز/بسته)
    if (sidebar && localStorage.getItem("sidebar-collapsed") === "1") {
        sidebar.classList.add("collapsed");
    }

    // زیرمنوها
    document.querySelectorAll(".menu-link.has-submenu").forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            const submenu = link.nextElementSibling;
            const isOpen = submenu.classList.contains("open");
            document.querySelectorAll(".submenu.open").forEach(s => s.classList.remove("open"));
            if (!isOpen) submenu.classList.add("open");
        });
    });
});
