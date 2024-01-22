document.addEventListener('DOMContentLoaded', function () {
    var open = false 
    var infoTrigger = document.getElementById('infoTrigger');
    var infoContainer = document.getElementById('infoContainer');
    
    // // Menambahkan event listener untuk menampilkan infoContainer saat diklik
    infoTrigger.addEventListener("click", function (event) {
        event.stopPropagation(); // Mencegah propogasi klik ke elemen lain
        // toggleInfo();
        if (open) {
            // hideInfo();
            infoContainer.style.display = 'block';    
        } else {
            // showInfo();
        infoContainer.style.display = 'none';
    
        }
        open = !open
    });
}); 