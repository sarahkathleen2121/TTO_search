/* ----------------------------------------------------
   THE TOTAL OFFICE OUR STORY - CUSTOM PREMIUM SCRIPT
   VERTICAL-TO-HORIZONTAL SCROLL STICKY INTERPOLATION
   ---------------------------------------------------- */

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('timelineContainer');
  const scrollPinTrack = document.getElementById('scrollPinTrack');
  const btnLeft = document.getElementById('navBtnLeft');
  const btnRight = document.getElementById('navBtnRight');
  const progressBarFill = document.getElementById('progressBarFill');

  let maxTranslate = 0;
  let targetX = 0;
  let currentX = 0;
  const easeFactor = 0.08; // Buttery smooth inertia
  let animFrameId = null;

  /* -----------------------------------------
     1. CALCULATE LIMITS & SET HEIGHT
     ----------------------------------------- */
  const calculateSizes = () => {
    if (window.innerWidth > 768 && container && scrollPinTrack) {
      // Max translation is total horizontal container width minus viewport width
      maxTranslate = Math.max(0, container.scrollWidth - window.innerWidth);
      // Set the vertical scroll track height to allow scrolling the full horizontal length
      scrollPinTrack.style.height = (maxTranslate + window.innerHeight) + 'px';
      
      // Update target based on current scroll position
      const rect = scrollPinTrack.getBoundingClientRect();
      const scrolledY = -rect.top;
      targetX = Math.max(0, Math.min(scrolledY, maxTranslate));
    } else {
      // Clear inline styles on mobile fallback
      if (container) container.style.transform = 'none';
      if (scrollPinTrack) scrollPinTrack.style.height = 'auto';
    }
  };

  // Run initial size calculations
  calculateSizes();
  
  // Use ResizeObserver to recalculate sizes dynamically as images/assets load and layout shifts
  if (container && typeof ResizeObserver !== 'undefined') {
    const resizeObserver = new ResizeObserver(() => {
      calculateSizes();
    });
    resizeObserver.observe(container);
  }

  // Also listen to window load event as a backup
  window.addEventListener('load', calculateSizes);
  
  // Re-calculate on window resize
  let resizeTimeout;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      calculateSizes();
    }, 150);
  });

  /* -----------------------------------------
     2. LERP INTERPOLATION LOOP (BUTTERY SMOOTH)
     ----------------------------------------- */
  const updateScrollLerp = () => {
    if (window.innerWidth > 768 && container) {
      // Smooth interpolation formula (Lerp)
      currentX += (targetX - currentX) * easeFactor;
      
      // Stop rendering if delta is infinitely small to save CPU
      if (Math.abs(targetX - currentX) < 0.05) {
        currentX = targetX;
      }
      
      // Apply exact horizontal transformation
      container.style.transform = `translateX(-${currentX}px)`;
      
      // Update progress bar
      if (maxTranslate > 0) {
        const progressPercent = (currentX / maxTranslate) * 100;
        if (progressBarFill) progressBarFill.style.width = `${progressPercent}%`;
      }
      
      // Update scroll-parallax floating textures
      const parallaxLayers = document.querySelectorAll('.scroll-parallax');
      parallaxLayers.forEach((layer) => {
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

      // Update background images parallax relative to parent section's offset
      const bgImages = document.querySelectorAll('.section-bg-img, .hero-bg-img, .cta-bg-img');
      bgImages.forEach((img) => {
        const parentSection = img.closest('.timeline-section');
        if (parentSection) {
          const sectionLeft = parentSection.offsetLeft;
          const sectionWidth = parentSection.offsetWidth || window.innerWidth;
          
          // Clamp relativeX to visible range to prevent infinite translation when scrolled far away
          const minRelative = -window.innerWidth;
          const maxRelative = sectionWidth;
          const relativeX = Math.max(minRelative, Math.min(maxRelative, currentX - sectionLeft));
          
          const bgOffset = relativeX * 0.35; // Gentle 35% parallax
          img.style.transform = `translateX(${bgOffset}px) scale(1.2)`;
        }
      });

    } else {
      // standard scroll update on mobile vertical list
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (docHeight > 0 && progressBarFill) {
        const progressPercent = (scrollTop / docHeight) * 100;
        progressBarFill.style.width = `${progressPercent}%`;
      }
    }
    
    // Recurse loop
    animFrameId = requestAnimationFrame(updateScrollLerp);
  };

  // Start smooth scrolling loop
  animFrameId = requestAnimationFrame(updateScrollLerp);

  /* -----------------------------------------
     3. NATIVE WINDOW SCROLL LISTENER
     ----------------------------------------- */
  window.addEventListener('scroll', () => {
    if (window.innerWidth > 768 && scrollPinTrack) {
      const rect = scrollPinTrack.getBoundingClientRect();
      const scrolledY = -rect.top;
      targetX = Math.max(0, Math.min(scrolledY, maxTranslate));
    }
  });

  /* -----------------------------------------
     4. NAVIGATION ARROWS (SCROLL THE PAGE VERTICALLY)
     ----------------------------------------- */
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
