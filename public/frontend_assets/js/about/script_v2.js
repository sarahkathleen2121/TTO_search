/* ----------------------------------------------------
   THE TOTAL OFFICE OUR STORY - CUSTOM PREMIUM SCRIPT
   VERTICAL-TO-HORIZONTAL SCROLL STICKY INTERPOLATION
   ---------------------------------------------------- */

document.addEventListener('DOMContentLoaded', () => {
  document.body.classList.add('about-page-active');

  const container = document.getElementById('timelineContainer');
  const scrollPinTrack = document.getElementById('scrollPinTrack');
  const btnLeft = document.getElementById('navBtnLeft');
  const btnRight = document.getElementById('navBtnRight');
  const progressBarFill = document.getElementById('progressBarFill');

  let maxTranslate = 0;
  let targetX = 0;
  let currentX = 0;
  const easeFactor = 0.08;
  let animFrameId = null;

  const isDesktopTimeline = () => window.innerWidth > 768;

  const clearDesktopTransforms = () => {
    if (container) container.style.transform = 'none';
    if (scrollPinTrack) scrollPinTrack.style.height = 'auto';

    document.querySelectorAll('.scroll-parallax').forEach((layer) => {
      layer.style.transform = '';
    });

    document.querySelectorAll('.section-bg-img').forEach((img) => {
      img.style.transform = '';
    });

    document.querySelectorAll('.hero-bg-img, .cta-bg-img').forEach((img) => {
      img.style.transform = 'scale(1.05)';
    });
  };

  const calculateSizes = () => {
    if (isDesktopTimeline() && container && scrollPinTrack) {
      maxTranslate = Math.max(0, container.scrollWidth - window.innerWidth);
      scrollPinTrack.style.height = (maxTranslate + window.innerHeight) + 'px';
    } else {
      maxTranslate = 0;
      clearDesktopTransforms();
    }
  };

  const readTargetFromScroll = () => {
    if (!isDesktopTimeline() || !scrollPinTrack) {
      targetX = 0;
      return;
    }

    const rect = scrollPinTrack.getBoundingClientRect();
    const scrolledY = Math.max(0, -rect.top);
    targetX = Math.max(0, Math.min(scrolledY, maxTranslate));
  };

  const applyVisualTransforms = () => {
    if (!isDesktopTimeline() || !container) return;

    container.style.transform = `translateX(-${currentX}px)`;

    if (maxTranslate > 0 && progressBarFill) {
      const progressPercent = (currentX / maxTranslate) * 100;
      progressBarFill.style.width = `${progressPercent}%`;
    }

    document.querySelectorAll('.scroll-parallax').forEach((layer) => {
      const speed = parseFloat(layer.getAttribute('data-speed')) || 0.1;
      const parentSection = layer.closest('.timeline-section');

      const isNewRelativeLayer = layer.classList.contains('layer-sofa-top') ||
        layer.classList.contains('layer-spec-sheet') ||
        layer.classList.contains('layer-six-right') ||
        layer.classList.contains('layer-fabric-top') ||
        layer.classList.contains('layer-chair-top');

      let relativeX = currentX;
      if (isNewRelativeLayer && parentSection) {
        relativeX = currentX - parentSection.offsetLeft;
      }
      const parallaxOffset = relativeX * speed;

      if (layer.classList.contains('layer-center') || layer.classList.contains('layer-spec-sheet')) {
        layer.style.transform = `translate(calc(-50% + ${parallaxOffset}px), -50%)`;
      } else if (layer.classList.contains('layer-sofa-top') ||
        layer.classList.contains('layer-fabric-top') ||
        layer.classList.contains('layer-chair-top')) {
        layer.style.transform = `translate(calc(-50% + ${parallaxOffset}px), 0)`;
      } else {
        layer.style.transform = `translateX(${parallaxOffset}px)`;
      }
    });

    // Hero & CTA backgrounds stay fixed inside their slide (no parallax shift)
    document.querySelectorAll('.hero-bg-img, .cta-bg-img').forEach((img) => {
      img.style.transform = 'scale(1.05)';
    });

    document.querySelectorAll('.section-bg-img').forEach((img) => {
      const parentSection = img.closest('.timeline-section');
      if (!parentSection) return;

      const sectionLeft = parentSection.offsetLeft;
      const sectionWidth = parentSection.offsetWidth || window.innerWidth;
      const minRelative = -window.innerWidth;
      const maxRelative = sectionWidth;
      const relativeX = Math.max(minRelative, Math.min(maxRelative, currentX - sectionLeft));
      const bgOffset = relativeX * 0.35;

      img.style.transform = `translateX(${bgOffset}px) scale(1.2)`;
    });
  };

  const syncScrollPosition = (snap = false) => {
    calculateSizes();
    readTargetFromScroll();

    if (snap) {
      currentX = targetX;
      applyVisualTransforms();
    }
  };

  calculateSizes();
  syncScrollPosition(true);

  if (container && typeof ResizeObserver !== 'undefined') {
    const resizeObserver = new ResizeObserver(() => {
      syncScrollPosition(true);
    });
    resizeObserver.observe(container);
  }

  window.addEventListener('load', () => syncScrollPosition(true));

  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => syncScrollPosition(true), 150);
  });

  // Fix bfcache / browser back: restore transforms to match scroll position
  window.addEventListener('pageshow', (event) => {
    requestAnimationFrame(() => {
      syncScrollPosition(true);
    });
  });

  const updateScrollLerp = () => {
    if (isDesktopTimeline() && container) {
      currentX += (targetX - currentX) * easeFactor;

      if (Math.abs(targetX - currentX) < 0.05) {
        currentX = targetX;
      }

      applyVisualTransforms();
    } else {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (docHeight > 0 && progressBarFill) {
        const progressPercent = (scrollTop / docHeight) * 100;
        progressBarFill.style.width = `${progressPercent}%`;
      }
    }

    animFrameId = requestAnimationFrame(updateScrollLerp);
  };

  animFrameId = requestAnimationFrame(updateScrollLerp);

  window.addEventListener('scroll', () => {
    readTargetFromScroll();
  });

  // Block trackpad / mouse horizontal wheel from scrolling the page sideways
  window.addEventListener('wheel', (event) => {
    if (!isDesktopTimeline()) return;
    if (event.deltaX !== 0) {
      event.preventDefault();
    }
  }, { passive: false });

  if (btnRight && btnLeft) {
    btnRight.addEventListener('click', () => {
      if (!scrollPinTrack) return;
      const scrollAmount = window.innerWidth;
      const trackTop = scrollPinTrack.offsetTop;
      const newTargetX = Math.max(0, Math.min(targetX + scrollAmount, maxTranslate));
      window.scrollTo({
        top: trackTop + newTargetX,
        behavior: 'smooth'
      });
    });

    btnLeft.addEventListener('click', () => {
      if (!scrollPinTrack) return;
      const scrollAmount = window.innerWidth;
      const trackTop = scrollPinTrack.offsetTop;
      const newTargetX = Math.max(0, Math.min(targetX - scrollAmount, maxTranslate));
      window.scrollTo({
        top: trackTop + newTargetX,
        behavior: 'smooth'
      });
    });
  }
});
