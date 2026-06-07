/* ----------------------------------------------------
   STELLAR WORKS BESPOKE PROCESS - CUSTOM PREMIUM SCRIPT
   ZERO-DRIFT SMOOTH LERP INTERPOLATION HORIZONTAL SCROLL
   ---------------------------------------------------- */

document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('timelineContainer');
  const btnLeft = document.getElementById('navBtnLeft');
  const btnRight = document.getElementById('navBtnRight');
  const progressBarFill = document.getElementById('progressBarFill');

  let maxTranslate = 0;
  let targetX = 0;
  let currentX = 0;
  const easeFactor = 0.08; // Adjust to control scroll inertia (smaller = smoother, larger = faster)
  let animFrameId = null;

  /* -----------------------------------------
     1. CALCULATE LIMITS
     ----------------------------------------- */
  const calculateSizes = () => {
    if (window.innerWidth > 768) {
      // Max translation is total container width minus screen width
      maxTranslate = container.scrollWidth - window.innerWidth;
      // Clamp targets on resize
      targetX = Math.max(0, Math.min(targetX, maxTranslate));
    } else {
      // Clear inline styles on mobile fallback
      container.style.transform = 'none';
    }
  };

  calculateSizes();
  
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
    if (window.innerWidth > 768) {
      // Dynamic recalculation prevents layout race conditions where scrollWidth is 0 on load
      maxTranslate = Math.max(0, container.scrollWidth - window.innerWidth);
      
      // Smooth interpolation formula (Lerp)
      currentX += (targetX - currentX) * easeFactor;
      
      // Stop rendering if delta is infinitely small to save CPU
      if (Math.abs(targetX - currentX) < 0.05) {
        currentX = targetX;
      }
      
      // Apply exact horizontal transformation ONLY - completely locked in vertical plane
      container.style.transform = `translateX(-${currentX}px)`;
      
      // Update custom top/bottom progress bar
      const progressPercent = (currentX / maxTranslate) * 100;
      progressBarFill.style.width = `${progressPercent}%`;
      
      // Update scroll-parallax floating textures
      const parallaxLayers = document.querySelectorAll('.scroll-parallax');
      parallaxLayers.forEach((layer) => {
        const speed = parseFloat(layer.getAttribute('data-speed')) || 0.1;
        const parentSection = layer.closest('.timeline-section');
        
        // Restrict local section relative offset to only new layers to prevent breaking previous layouts
        const isNewRelativeLayer = layer.classList.contains('layer-sofa-top') || 
                                   layer.classList.contains('layer-spec-sheet') || 
                                   layer.classList.contains('layer-six-right') ||
                                   layer.classList.contains('layer-leather-right') ||
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

      // Update background images parallax relative to their parent section's offset to create "cards sliding over background" effect!
      const bgImages = document.querySelectorAll('.section-bg-img, .hero-bg-img, .cta-bg-img');
      bgImages.forEach((img) => {
        const parentSection = img.closest('.timeline-section');
        if (parentSection) {
          const sectionLeft = parentSection.offsetLeft;
          // Calculate scroll offset relative to the section's position
          const relativeX = currentX - sectionLeft;
          // Gentle parallax factor: 0.35 (background moves 35% slower than container, giving "cards slide on top" illusion)
          const bgOffset = relativeX * 0.35;
          img.style.transform = `translateX(${bgOffset}px) scale(1.2)`;
        }
      });

    } else {
      // standard scroll update on mobile vertical list
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (docHeight > 0) {
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
     3. DIRECT WHEEL INTERCEPT (ZERO VERTICAL SCROLL)
     ----------------------------------------- */
  window.addEventListener('wheel', (e) => {
    if (window.innerWidth > 768) {
      // Prevent browser default vertical window scroll completely
      e.preventDefault();
      
      // Map vertical wheel delta directly to target horizontal offset
      targetX += e.deltaY * 0.95; // Multiplier adjusts scrolling sensitivity
      targetX = Math.max(0, Math.min(targetX, maxTranslate));
    }
  }, { passive: false });

  /* -----------------------------------------
     4. NAVIGATION ARROWS (INCREMENTS TARGET DIRECTLY)
     ----------------------------------------- */
  // Incremented step size to match expanded step section paddings and larger card widths
  btnRight.addEventListener('click', () => {
    const scrollAmount = window.innerWidth; // Moves by exactly 100% of viewport width for perfect slide alignment
    targetX = Math.max(0, Math.min(targetX + scrollAmount, maxTranslate));
  });

  btnLeft.addEventListener('click', () => {
    const scrollAmount = window.innerWidth;
    targetX = Math.max(0, Math.min(targetX - scrollAmount, maxTranslate));
  });

  // Dynamic vertical tracking listener for mobile scrollbar representation
  window.addEventListener('scroll', () => {
    if (window.innerWidth <= 768) {
      const scrollTop = window.scrollY || document.documentElement.scrollTop;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      if (docHeight > 0) {
        const progressPercent = (scrollTop / docHeight) * 100;
        progressBarFill.style.width = `${progressPercent}%`;
      }
    }
  });
});
