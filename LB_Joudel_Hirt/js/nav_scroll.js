window.addEventListener("load", function() {
    function scrollueberwachung() {
        let element = document.getElementById("headimg").scrollHeight
        let abstandvonoben = window.pageYOffset;
        let desktopnav =  document.getElementById("navbar");
        if (abstandvonoben > element && !desktopnav.classList.contains("navbar fixed-top")) {
            desktopnav.className = "navbar fixed-top navbar-dark bg-dark navbar-expand-lg bg-dark";
        }
        else {
            document.getElementById("navbar").className = "navbar navbar-dark bg-dark navbar-expand-lg bg-dark";
        }
    }
    window.addEventListener("scroll", scrollueberwachung);
} );