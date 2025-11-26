// DigNet Network Animation - Interactive effects
document.addEventListener('DOMContentLoaded', function() {
  // Add click interaction to mascot
  const mascot = document.querySelector('.mascot');
  if (mascot) {
    mascot.addEventListener('click', function() {
      mascot.classList.add('jump');
      setTimeout(function() {
        mascot.classList.remove('jump');
      }, 1000);
    });
  }
  
  // Add random LED blinking patterns
  const leds = document.querySelectorAll('.mascot-led, .router-led');
  leds.forEach((led, index) => {
    setInterval(() => {
      led.style.opacity = Math.random() > 0.3 ? '1' : '0.3';
    }, 500 + Math.random() * 500);
  });
  
  // Password field animation - make mascot cover eyes
  const passwordInput = document.querySelector('input[type="password"]');
  if (passwordInput) {
    passwordInput.addEventListener('focus', function() {
      document.body.classList.add('password');
    });
    passwordInput.addEventListener('blur', function() {
      document.body.classList.remove('password');
    });
  }
  
  // Create floating particles dynamically
  function createParticle() {
    const particle = document.createElement('div');
    particle.className = 'floating-particle';
    particle.style.cssText = `
      position: fixed;
      width: ${Math.random() * 4 + 2}px;
      height: ${Math.random() * 4 + 2}px;
      background: rgba(102, 126, 234, ${Math.random() * 0.5 + 0.3});
      border-radius: 50%;
      left: ${Math.random() * 100}%;
      top: 100%;
      pointer-events: none;
      z-index: 0;
    `;
    document.body.appendChild(particle);
    
    const duration = Math.random() * 5000 + 5000;
    particle.animate([
      { transform: 'translateY(0)', opacity: 1 },
      { transform: `translateY(-${window.innerHeight + 50}px)`, opacity: 0 }
    ], {
      duration: duration,
      easing: 'linear'
    }).onfinish = () => particle.remove();
  }
  
  // Create particles periodically
  setInterval(createParticle, 500);
  
  // Add connection line pulse effect
  const connectionLines = document.querySelectorAll('.connection-line');
  connectionLines.forEach((line, index) => {
    setInterval(() => {
      line.style.boxShadow = `0 0 ${Math.random() * 10 + 5}px rgba(102, 126, 234, 0.6)`;
    }, 200);
  });
});

// Add jump animation style
const style = document.createElement('style');
style.textContent = `
  .mascot.jump .mascot-body {
    animation: mascot-jump 0.5s ease-out !important;
  }
  
  @keyframes mascot-jump {
    0% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(-30px); }
    100% { transform: translateX(-50%) translateY(0); }
  }
`;
document.head.appendChild(style);
