



function toggleSkills() {
  const skills = document.querySelector(".skills-text");

  if (skills.style.display === "none") {
    skills.style.display = "block";
  } else {
    skills.style.display = "none";
  }
}



// Mobile Menu Toggle
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
        
        // Prevent body scroll when menu is open
        if (navMenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });
}

// Close menu when clicking on a link
if (navMenu) {
    document.querySelectorAll('.nav-menu a').forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            if (hamburger) {
                hamburger.classList.remove('active');
            }
            document.body.style.overflow = '';
        });
    });
}

// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Counter Animation for Stats
const animateCounter = (element, target, duration = 2000) => {
    let start = 0;
    const increment = target / (duration / 16);
    
    const updateCounter = () => {
        start += increment;
        if (start < target) {
            element.textContent = Math.floor(start);
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target;
        }
    };
    
    updateCounter();
};

// Intersection Observer for Stats Animation
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
            const target = parseInt(entry.target.getAttribute('data-target'));
            animateCounter(entry.target, target);
            entry.target.classList.add('animated');
        }
    });
}, {
    threshold: 0.5
});

// Observe all stat numbers
document.querySelectorAll('.stat-number').forEach(stat => {
    statsObserver.observe(stat);
});

// Header Scroll Effect
let lastScroll = 0;
const header = document.querySelector('.header');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.15)';
    } else {
        header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
    }
    
    lastScroll = currentScroll;
});

// Portfolio Item Hover Effect Enhancement



  const filterButtons = document.querySelectorAll(".filter-btn");
  const items = document.querySelectorAll(".portfolio-item");

  filterButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      // active button
      filterButtons.forEach(b => b.classList.remove("active"));
      btn.classList.add("active");

      const filter = btn.dataset.filter;

      items.forEach(item => {
        const category = item.dataset.category;

        // show/hide with animation
        const shouldShow = (filter === "all" || category === filter);

        if (shouldShow) {
          item.classList.remove("is-hidden");
          item.style.display = "block";
          requestAnimationFrame(() => {
            item.style.opacity = "1";
          });
        } else {
          item.classList.add("is-hidden");
          // wait animation then display none
          setTimeout(() => {
            item.style.display = "none";
          }, 250);
        }
      });
    });
  });



const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightboxImage");
  const counterEl = document.getElementById("lightboxCounter");

  const closeBtn = document.querySelector(".lightbox-close");
  const overlay = document.querySelector(".lightbox-overlay");
  const prevBtn = document.querySelector(".lightbox-nav.prev");
  const nextBtn = document.querySelector(".lightbox-nav.next");

  // Collect all portfolio images (this becomes the gallery)
  let gallery = Array.from(document.querySelectorAll(".portfolio-image img"));
  let currentIndex = 0;

  function updateCounter(){
    counterEl.textContent = `${currentIndex + 1} / ${gallery.length}`;
  }

  function openLightbox(index){
    // refresh gallery (important if filtering changes display)
    gallery = Array.from(document.querySelectorAll(".portfolio-item:not([style*='display: none']) .portfolio-image img"));

    currentIndex = Math.max(0, Math.min(index, gallery.length - 1));
    lightboxImg.src = gallery[currentIndex].src;

    updateCounter();
    lightbox.classList.add("show");
    document.body.style.overflow = "hidden";
  }

  function closeLightbox(){
    lightbox.classList.remove("show");
    document.body.style.overflow = "";
  }

  function showNext(){
    if(!gallery.length) return;
    currentIndex = (currentIndex + 1) % gallery.length; // loop
    lightboxImg.src = gallery[currentIndex].src;
    updateCounter();
  }

  function showPrev(){
    if(!gallery.length) return;
    currentIndex = (currentIndex - 1 + gallery.length) % gallery.length; // loop
    lightboxImg.src = gallery[currentIndex].src;
    updateCounter();
  }

  // Click image → open
  document.addEventListener("click", (e) => {
    const img = e.target.closest(".portfolio-image img");
    if(!img) return;

    // Build visible gallery list and open at clicked index
    const visibleImgs = Array.from(document.querySelectorAll(".portfolio-item:not([style*='display: none']) .portfolio-image img"));
    const index = visibleImgs.indexOf(img);
    openLightbox(index);
  });

  // Buttons + overlay
  closeBtn.addEventListener("click", closeLightbox);
  overlay.addEventListener("click", closeLightbox);
  nextBtn.addEventListener("click", showNext);
  prevBtn.addEventListener("click", showPrev);

  // Keyboard
  document.addEventListener("keydown", (e) => {
    if(!lightbox.classList.contains("show")) return;

    if(e.key === "Escape") closeLightbox();
    if(e.key === "ArrowRight") showNext();
    if(e.key === "ArrowLeft") showPrev();
  });
 



  






// Newsletter Form Submission
const newsletterForm = document.querySelector('.newsletter-form');
if (newsletterForm) {
    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = newsletterForm.querySelector('input[type="email"]').value;
        if (email) {
            alert('Thank you for subscribing!');
            newsletterForm.querySelector('input[type="email"]').value = '';
        }
    });
}

// Fade in animation on scroll
const fadeInObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, {
    threshold: 0.1
});

// Apply fade-in to sections
document.querySelectorAll('section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(30px)';
    section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    fadeInObserver.observe(section);
});

// Button Click Effects
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add ripple effect styles dynamically
const style = document.createElement('style');
style.textContent = `
    .btn {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Active Navigation Link Highlighting
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-menu a');

window.addEventListener('scroll', () => {
    let current = '';
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (window.pageYOffset >= sectionTop - 200) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// Add active link styles
const activeStyle = document.createElement('style');
activeStyle.textContent = `
    .nav-menu a.active {
        color: var(--primary-color);
        font-weight: 600;
    }
`;
document.head.appendChild(activeStyle);

// Contact Form Validation and Interactivity
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const subjectInput = document.getElementById('subject');
    const messageInput = document.getElementById('message');
    const submitBtn = contactForm.querySelector('.btn-contact-submit');
    const formSuccess = document.getElementById('formSuccess');

    // Real-time validation
    const validateField = (input, errorElement, validator) => {
        const value = input.value.trim();
        const isValid = validator(value);
        
        if (!isValid && value.length > 0) {
            input.classList.add('error');
            errorElement.textContent = getErrorMessage(input.id);
            errorElement.classList.add('show');
            return false;
        } else {
            input.classList.remove('error');
            errorElement.classList.remove('show');
            return true;
        }
    };

    const getErrorMessage = (fieldId) => {
        const messages = {
            name: 'Please enter a valid name (at least 2 characters)',
            email: 'Please enter a valid email address',
            subject: 'Please enter a subject (at least 3 characters)',
            message: 'Please enter a message (at least 10 characters)'
        };
        return messages[fieldId] || 'Invalid input';
    };

    const validators = {
        name: (value) => value.length >= 2 && /^[a-zA-Z\s]+$/.test(value),
        email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value),
        subject: (value) => value.length >= 3,
        message: (value) => value.length >= 10
    };

    // Add event listeners for real-time validation
    [nameInput, emailInput, subjectInput, messageInput].forEach(input => {
        input.addEventListener('blur', () => {
            const errorElement = document.getElementById(input.id + 'Error');
            validateField(input, errorElement, validators[input.id]);
        });

        input.addEventListener('input', () => {
            if (input.classList.contains('error')) {
                const errorElement = document.getElementById(input.id + 'Error');
                validateField(input, errorElement, validators[input.id]);
            }
        });
    });

//     // Form submission
//     contactForm.addEventListener('submit', async (e) => {
//         e.preventDefault();

//         // Validate all fields
//         let isValid = true;
//         const fields = [
//             { input: nameInput, validator: validators.name },
//             { input: emailInput, validator: validators.email },
//             { input: subjectInput, validator: validators.subject },
//             { input: messageInput, validator: validators.message }
//         ];

//         fields.forEach(({ input, validator }) => {
//             const errorElement = document.getElementById(input.id + 'Error');
//             if (!validateField(input, errorElement, validator)) {
//                 isValid = false;
//             }
//         });

//         if (!isValid) {
//             // Scroll to first error
//             const firstError = contactForm.querySelector('.form-input.error');
//             if (firstError) {
//                 firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
//                 firstError.focus();
//             }
//             return;
//         }

//         // Show loading state
//         submitBtn.classList.add('loading');
//         submitBtn.disabled = true;
//         submitBtn.querySelector('span').textContent = 'SENDING...';

//         // Simulate form submission (replace with actual API call)
//         try {
//             await new Promise(resolve => setTimeout(resolve, 1500)); // Simulate API call

//             // Show success message
//             formSuccess.style.display = 'flex';
//             contactForm.reset();
            
//             // Remove error classes
//             contactForm.querySelectorAll('.form-input').forEach(input => {
//                 input.classList.remove('error');
//             });
//             contactForm.querySelectorAll('.form-error').forEach(error => {
//                 error.classList.remove('show');
//             });

//             // Scroll to success message
//             formSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });

//             // Hide success message after 5 seconds
//             setTimeout(() => {
//                 formSuccess.style.display = 'none';
//             }, 5000);

//         } catch (error) {
//             alert('Something went wrong. Please try again.');
//         } finally {
//             submitBtn.classList.remove('loading');
//             submitBtn.disabled = false;
//             submitBtn.querySelector('span').textContent = 'SEND MESSAGE';
//         }
//     });
// }

// Animate contact info cards on scroll
const contactCards = document.querySelectorAll('.contact-info-card');
if (contactCards.length > 0) {
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1
    });

    contactCards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
        cardObserver.observe(card);
    });
}



// Smooth scroll to contact section
document.querySelectorAll('a[href="#contact"]').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const contactSection = document.getElementById('contact');
        if (contactSection) {
            contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

console.log('Portfolio website loaded successfully!');
}
