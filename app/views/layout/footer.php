<?php if(isset($_SESSION['email'])): ?>
</div>
<footer class = "footer"></footer>
<?php endif; ?>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.2.2/af-2.7.0/b-3.2.2/b-colvis-3.2.2/b-html5-3.2.2/b-print-3.2.2/cr-2.0.4/date-1.5.5/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.4/rg-1.5.1/rr-1.5.0/sc-2.4.3/sb-1.8.2/sp-2.3.3/sl-3.0.0/sr-1.4.1/datatables.min.js" integrity="sha384-10kTwhFyUU637a6/7q0kLBdo8jQWjxteg63DT/K8Sdq/nCDaDAkH+Nq/MIrsp8wc" crossorigin="anonymous"></script>
    
    <!-- Chart.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JS -->
    <script src= "/student_management_system/assets/js/bootstrap.min.js"></script>
    <script src="/student_management_system/assets/js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var header = document.querySelector(".home-content");
            var bg = document.querySelector(".bg");
            var footer = document.querySelector(".footer");
            var menuBar = document.getElementById("menu");
            var plogo = document.querySelector(".p-logo");
            var plink = document.querySelector(".p-link");

            function expandHeader(event) {
                event.preventDefault(); 

                header.style.minHeight = "50vh"; 
                footer.style.minHeight = "50vh"; 
                bg.style.display = "none"; 
                menuBar.style.display = "none";
                plogo.style.display = "none"; 
                plink.style.display = "none"; 
                header.style.zIndex = "-1";

                header.style.transition = "min-height 1s ease-in-out"; 
                bg.style.transition = "opacity 5s ease-in-out"; 

                setTimeout(() => {
                    header.style.minHeight = "60px"; 
                    footer.style.minHeight = "60px"; 

                    setTimeout(() => {
                        window.location.href = event.target.href;
                    }, 1000);
                }, 1000); 
            }

            document.querySelectorAll(".l").forEach(link => {
                link.addEventListener("click", expandHeader);
            });

            document.querySelectorAll(".d-link").forEach(item => {
                item.addEventListener("click", expandHeader);
            });
        });
    </script>
    <script>
        function updateBackgroundHeight() {
            var sidebar = document.querySelector(".sidebar");
            var footer = document.querySelector(".footer");
            var bg = document.querySelector(".full-screen-bg");

            if (sidebar && footer && bg) {
                bg.style.height = (sidebar.offsetHeight - (footer.offsetHeight * 2)) + "px";
            }
        }

        const resizeObserver = new ResizeObserver(() => {
            updateBackgroundHeight();
        });

        var sidebar = document.querySelector(".sidebar");
        var footer = document.querySelector(".footer");

        if (sidebar) resizeObserver.observe(sidebar);
        if (footer) resizeObserver.observe(footer);

        document.addEventListener("DOMContentLoaded", updateBackgroundHeight);
    </script>


</body>
</html>