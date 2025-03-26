// Main JavaScript file

document.addEventListener("DOMContentLoaded", function () {
  // Initialize mobile menu
  initMobileMenu();

  // Initialize header scroll effect
  initHeaderScroll();

  // Initialize smooth scrolling for anchor links
  initSmoothScroll();

  initNavLink();
  // Initialize form validation if forms exist
  const forms = document.querySelectorAll("form");
  if (forms.length > 0) {
    forms.forEach((form) => {
      initFormValidation(form);
    });
  }
});

// Mobile Menu Toggle
function initMobileMenu() {
  const hamburger = document.querySelector(".hamburger");
  const navMenu = document.querySelector(".nav-menu");

  if (!hamburger || !navMenu) return;

  hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
  });

  // Close mobile menu when clicking on a menu item
  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", () => {
      hamburger.classList.remove("active");
      navMenu.classList.remove("active");
    });
  });
}
function initNavLink(){
  const navLink = document.querySelectorAll(".nav-link");
  const windowPathname = window.location.search;

  navLink.forEach(navLinkEl=>{
    const navLinkPathname = navLinkEl.getAttribute('href');
    if(windowPathname == navLinkPathname){
      navLinkEl.classList.add("active");
    }
  });
}
// Header scroll effect
function initHeaderScroll() {
  const header = document.querySelector(".header");

  if (!header) return;

  window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
}

// Smooth scrolling for anchor links
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href");

      if (targetId === "#") return;

      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        e.preventDefault();

        window.scrollTo({
          top: targetElement.offsetTop - 80, // Adjust for header height
          behavior: "smooth",
        });
      }
    });
  });
}

// Form validation
function initFormValidation(form) {
  form.addEventListener("submit", function (e) {
    let isValid = true;
    const requiredFields = form.querySelectorAll("[required]");

    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        isValid = false;
        field.classList.add("error");
      } else {
        field.classList.remove("error");
      }

      // Email validation
      if (field.type === "email" && field.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value.trim())) {
          isValid = false;
          field.classList.add("error");
        }
      }
    });

    if (!isValid) {
      e.preventDefault();
      alert("Please fill in all required fields correctly.");
    } else {
      // For demo purposes - replace with actual form submission
      if (
        form.classList.contains("contact-form") ||
        form.classList.contains("newsletter-form")
      ) {
        e.preventDefault();
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;

        submitButton.disabled = true;
        submitButton.textContent = "Sending...";
        
        
        if(form.getAttribute("name") == "contact"){
          const formData = new FormData();
          formData.append('name', form.elements.namedItem("name").value);
          formData.append('email',form.elements.namedItem("email").value);
          formData.append('subject',form.elements.namedItem("subject").value);
          formData.append('message',form.elements.namedItem("message").value);
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            if(this.responseText){
                    // Simulate API call
                    setTimeout(() => {
                      form.reset();
                      submitButton.textContent = "Sent Successfully!";
      
                      setTimeout(() => {
                        submitButton.disabled = false;
                        submitButton.textContent = originalText;
                      }, 2000);
                    }, 1500);
                  }
          }
          xhttp.open("POST", "src/php/contact.php",true);
          xhttp.send(formData);
        }
        else{
          // Simulate API call
          setTimeout(() => {
            form.reset();
            submitButton.textContent = "Sent Successfully!";

            setTimeout(() => {
              submitButton.disabled = false;
              submitButton.textContent = originalText;
            }, 2000);
          }, 1500);
        }
        
      }
    }
  });

  // Real-time validation
  const inputs = form.querySelectorAll("input, textarea");
  inputs.forEach((input) => {
    input.addEventListener("blur", function () {
      if (this.hasAttribute("required") && !this.value.trim()) {
        this.classList.add("error");
      } else {
        this.classList.remove("error");
      }

      // Email validation
      if (this.type === "email" && this.value.trim()) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.value.trim())) {
          this.classList.add("error");
        } else {
          this.classList.remove("error");
        }
      }
    });
  });
}
