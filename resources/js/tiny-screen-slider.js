document.addEventListener('DOMContentLoaded', function() {
    
    function adjustSliderButtons() {
        const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

        if (vw <= 320) {

            const prevButton = document.querySelector('#advantages button.absolute.left-14');
            const nextButton = document.querySelector('#advantages button.absolute.right-14');
            
            if (prevButton) {
                prevButton.classList.remove('left-14');
                prevButton.classList.add('left-2');
                prevButton.classList.remove('w-11', 'h-11');
                prevButton.classList.add('w-8', 'h-8');

                const prevIcon = prevButton.querySelector('svg');
                if (prevIcon) {
                    prevIcon.classList.remove('w-8', 'h-8');
                    prevIcon.classList.add('w-6', 'h-6');
                }
            }
            
            if (nextButton) {
                nextButton.classList.remove('right-14');
                nextButton.classList.add('right-2');
                nextButton.classList.remove('w-11', 'h-11');
                nextButton.classList.add('w-8', 'h-8');
                nextButton.style.right = '2px'; 
                nextButton.style.left = 'auto'; 

                const nextIcon = nextButton.querySelector('svg');
                if (nextIcon) {
                    nextIcon.classList.remove('w-8', 'h-8');
                    nextIcon.classList.add('w-6', 'h-6');
                }
            }

            const sliderFigures = document.querySelectorAll('#advantages figure.h-96');
            sliderFigures.forEach(figure => {
                figure.classList.remove('h-96');
                figure.classList.add('h-64');
            });

            const captions = document.querySelectorAll('#advantages figcaption');
            captions.forEach(caption => {
                caption.classList.remove('w-96');
                caption.classList.add('w-full');
                caption.style.fontSize = '0.7rem';
                caption.style.padding = '0.25rem';
            });

            const nextButtonFixed = document.querySelector('#advantages button.absolute.right-2');
            if (nextButtonFixed) {
                nextButtonFixed.classList.remove('translate-y-1/2');
                nextButtonFixed.classList.add('-translate-y-1/2'); 
                nextButtonFixed.classList.remove('xsm:top-[39%]', 'xl:top-[40%]');
                nextButtonFixed.classList.add('top-1/2');
                nextButtonFixed.style.right = '2px'; 
                nextButtonFixed.style.left = 'auto'; 
            }
        }
        // Untuk layar 321px - 480px
        else if (vw <= 480) {

            const prevButton = document.querySelector('#advantages button.absolute.left-14');
            const nextButton = document.querySelector('#advantages button.absolute.right-14');
            
            if (prevButton) {
                prevButton.classList.remove('left-14');
                prevButton.classList.add('left-4');
            }
            
            if (nextButton) {
                nextButton.classList.remove('right-14');
                nextButton.classList.add('right-4');
                nextButton.style.right = '4px'; 
                nextButton.style.left = 'auto'; 

                nextButton.classList.remove('translate-y-1/2');
                nextButton.classList.add('-translate-y-1/2');
                nextButton.classList.remove('xsm:top-[39%]', 'xl:top-[40%]');
                nextButton.classList.add('top-1/2');
            }

            const captions = document.querySelectorAll('#advantages figcaption');
            captions.forEach(caption => {
                caption.classList.remove('w-96');
                caption.classList.add('w-[90%]');
            });
        } else {

            const nextButton = document.querySelector('#advantages button.absolute.right-14');
            if (nextButton) {
                nextButton.classList.remove('translate-y-1/2');
                nextButton.classList.add('-translate-y-1/2');
                nextButton.classList.remove('xsm:top-[39%]', 'xl:top-[40%]');
                nextButton.classList.add('top-1/2');
                nextButton.style.right = '3.5rem'; 
                nextButton.style.left = 'auto'; 
            }
        }
    }
    
    // Jalankan saat halaman dimuat dan setelah 1 detik (untuk memastikan semua elemen DOM sudah dirender)
    setTimeout(adjustSliderButtons, 100);
    setTimeout(adjustSliderButtons, 1000);
    
    // Jalankan kembali saat ukuran layar berubah
    window.addEventListener('resize', adjustSliderButtons);
}); 