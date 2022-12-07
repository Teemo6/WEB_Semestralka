function togglePDF(id) {
    var window = document.getElementById("PDF_" + id);
    if (window.style.display === "block") {
        window.style.display = "none";
    } else {
        window.style.display = "block";
    }
}