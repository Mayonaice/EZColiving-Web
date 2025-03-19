// Script untuk menangani responsifitas pada layar kecil
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk menyesuaikan elemen berdasarkan ukuran layar
    function adjustForSmallScreens() {
        const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        
        // Untuk layar yang sangat kecil (280px - 320px)
        if (vw <= 320) {
            // Menyesuaikan ukuran tombol
            const floatingButtons = document.querySelectorAll('.fixed.bottom-6.right-6 .w-12.h-12');
            floatingButtons.forEach(button => {
                button.classList.remove('w-12', 'h-12');
                button.classList.add('w-8', 'h-8');
            });
            
            // Menyesuaikan ukuran ikon di sidebar
            const sidebarIcons = document.querySelectorAll('aside svg');
            sidebarIcons.forEach(icon => {
                icon.style.width = '14px';
                icon.style.height = '14px';
            });
            
            // Menyesuaikan lebar sidebar
            const sidebar = document.querySelector('aside.h-full');
            if (sidebar) {
                sidebar.style.width = '24px';
            }
            
            // Menyesuaikan margin konten utama
            const mainContent = document.querySelector('.w-full.h-full.flex.flex-col.justify-between');
            if (mainContent) {
                mainContent.style.marginLeft = '24px';
            }
            
            // Menyesuaikan tombol slider
            const sliderButtons = document.querySelectorAll('#advantages button.absolute');
            sliderButtons.forEach(button => {
                if (button.classList.contains('left-14')) {
                    button.classList.remove('left-14');
                    button.classList.add('left-2');
                }
                if (button.classList.contains('right-14')) {
                    button.classList.remove('right-14');
                    button.classList.add('right-2');
                }
            });
        }
    }
    
    // Jalankan saat halaman dimuat
    adjustForSmallScreens();
    
    // Jalankan kembali saat ukuran layar berubah
    window.addEventListener('resize', adjustForSmallScreens);
}); 