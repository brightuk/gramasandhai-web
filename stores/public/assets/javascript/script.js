class BannerSlider {
    constructor() {
        this.slidesContainer = document.getElementById('slidesContainer');
        this.slides = document.querySelectorAll('.slide');
        this.pagination = document.getElementById('pagination');
        this.progressBar = document.getElementById('progressBar');
        this.prevBtn = document.getElementById('prevBtn');
        this.nextBtn = document.getElementById('nextBtn');
        this.loading = document.querySelector('.loading');
        
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        this.isAutoPlaying = true;
        this.autoPlayInterval = 5000; // 5 seconds
        this.progressInterval = null;
        this.autoPlayTimer = null;
        
        this.init();
    }

    init() {
        this.createPagination();
        this.bindEvents();
        this.startAutoPlay();
        this.hideLoading();
        this.updateSlider();
    }

    hideLoading() {
        setTimeout(() => {
            this.loading.style.display = 'none';
        }, 500);
    }

    createPagination() {
        this.pagination.innerHTML = '';
        for (let i = 0; i < this.totalSlides; i++) {
            const dot = document.createElement('div');
            dot.className = `dot ${i === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => this.goToSlide(i));
            this.pagination.appendChild(dot);
        }
    }

    bindEvents() {
        this.prevBtn.addEventListener('click', () => this.prevSlide());
        this.nextBtn.addEventListener('click', () => this.nextSlide());
        
        // Touch/swipe support
        let startX = 0;
        let endX = 0;
        
        this.slidesContainer.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        }, { passive: true });
        
        this.slidesContainer.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            this.handleSwipe(startX, endX);
        }, { passive: true });

        // Pause auto-play on hover
        this.slidesContainer.addEventListener('mouseenter', () => {
            this.pauseAutoPlay();
        });

        this.slidesContainer.addEventListener('mouseleave', () => {
            this.startAutoPlay();
        });
    }

    handleSwipe(startX, endX) {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                this.nextSlide();
            } else {
                this.prevSlide();
            }
        }
    }

    goToSlide(index) {
        this.currentSlide = index;
        this.updateSlider();
        this.restartAutoPlay();
    }

    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateSlider();
        this.restartAutoPlay();
    }

    prevSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.updateSlider();
        this.restartAutoPlay();
    }

    updateSlider() {
        // Update slides position
        const translateX = -this.currentSlide * 100;
        this.slidesContainer.style.transform = `translateX(${translateX}%)`;
        
        // Update pagination
        document.querySelectorAll('.dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
        });
    }

    startAutoPlay() {
        if (!this.isAutoPlaying) return;
        
        this.autoPlayTimer = setTimeout(() => {
            this.nextSlide();
        }, this.autoPlayInterval);
        
        this.startProgressBar();
    }

    pauseAutoPlay() {
        clearTimeout(this.autoPlayTimer);
        clearInterval(this.progressInterval);
        this.progressBar.style.width = '0%';
    }

    restartAutoPlay() {
        this.pauseAutoPlay();
        this.startAutoPlay();
    }

    startProgressBar() {
        this.progressBar.style.width = '0%';
        let progress = 0;
        const increment = 100 / (this.autoPlayInterval / 100);
        
        this.progressInterval = setInterval(() => {
            progress += increment;
            this.progressBar.style.width = `${progress}%`;
            
            if (progress >= 100) {
                clearInterval(this.progressInterval);
            }
        }, 100);
    }
}

// Initialize slider when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new BannerSlider();
});


document.addEventListener('DOMContentLoaded', function () {
    const sliderWrapper = document.getElementById('sliderWrapper_2');
    const prevBtn = document.getElementById('prevBtn2');
    const nextBtn = document.getElementById('nextBtn2');

    const scrollAmount = 250; // pixels to scroll each click

    nextBtn.addEventListener('click', () => {
        sliderWrapper.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    prevBtn.addEventListener('click', () => {
        sliderWrapper.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    // Sample implementation for load more button
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const shopGrid = document.getElementById('shopGrid');
    const shopCards = document.querySelectorAll('.shop-card');

    // Initially show first 3 cards
    shopCards.forEach((card, index) => {
        if (index < 8) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });

    // Load more functionality
    loadMoreBtn.addEventListener('click', function () {
        const hiddenCards = document.querySelectorAll('.shop-card[style="display: none;"]');
        hiddenCards.forEach((card, index) => {
            if (index < 4) {
                card.style.display = 'block';
            }
        });

        // Hide button if no more cards to show
        if (document.querySelectorAll('.shop-card[style="display: none;"]').length === 0) {
            loadMoreBtn.style.display = 'none';
        }
    });
});




