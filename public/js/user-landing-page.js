document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault(); 
      const targetId = this.getAttribute('href').substring(1); 
      const targetElement = document.getElementById(targetId);
      
      if (targetElement) {
          targetElement.scrollIntoView({ behavior: 'smooth' });
      }
  });
});

document.addEventListener('alpine:init', () => {
  Alpine.data('slider', () => ({
      currentIndex: 1,
      images: [
          '/banner/carousel/2th-floor-kitchen.jpeg',
          '/banner/carousel/2th-floor-tables.jpeg',
          '/banner/carousel/5th-floor-front.jpeg',
          '/banner/carousel/5th-floor-side.jpeg',
      ],
      startX: 0,
      endX: 0,
      isDragging: false,
      isNavigating: false, 
      
      back() {
          if (this.isNavigating) return;
          this.isNavigating = true;
          this.currentIndex = this.currentIndex > 1 ? this.currentIndex - 1 : this.images.length;
          setTimeout(() => this.isNavigating = false, 300); 
      },

      next() {
          if (this.isNavigating) return;
          this.isNavigating = true;
          this.currentIndex = this.currentIndex < this.images.length ? this.currentIndex + 1 : 1;
          setTimeout(() => this.isNavigating = false, 300); 
      },

      handleTouchStart(event) {
          this.startX = event.touches[0].clientX;
          this.isDragging = true;
      },
      handleTouchMove(event) {
          if (!this.isDragging) return;
          this.endX = event.touches[0].clientX;
      },
      handleTouchEnd() {
          this.isDragging = false;
          this.detectSwipe();
      },

      handleMouseDown(event) {
          this.startX = event.clientX;
          this.isDragging = true;
      },
      handleMouseMove(event) {
          if (!this.isDragging) return;
          this.endX = event.clientX;
      },
      handleMouseUp() {
          this.isDragging = false;
          this.detectSwipe();
      },

      detectSwipe() {
          const swipeDistance = this.startX - this.endX;
          if (swipeDistance > 50) this.next();
          else if (swipeDistance < -50) this.back();
          this.startX = 0;
          this.endX = 0;
      },
  }));
});

document.addEventListener('alpine:init', () => {
  Alpine.store('accordion', {
    tab: 0
  });

  Alpine.data('accordion', (idx) => ({
    init() {
      this.idx = idx;
    },
    idx: -1,
    handleClick() {
      this.$store.accordion.tab = this.$store.accordion.tab === this.idx ? 0 : this.idx;
    },
    handleRotate() {
      return this.$store.accordion.tab === this.idx ? 'rotate-180' : '';
    },
    handleToggle() {
      return this.$store.accordion.tab === this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
    }
  }));
})