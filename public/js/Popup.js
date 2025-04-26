   /*for popup----------------------------------------------*/
   document.addEventListener('DOMContentLoaded', function() {
    // Get all trigger elements
    const triggers = document.querySelectorAll('.popup-trigger');
    const popup = document.getElementById('popup');
    const closeBtn = document.querySelector('.close-btn');
    const body = document.body;
    
    // Function to open popup
    function openPopup() {
        popup.style.display = 'flex';
        body.style.overflow = 'hidden';
        popup.setAttribute('aria-hidden', 'false');
    }
    
    // Function to close popup
    function closePopup() {
        popup.style.display = 'none';
        body.style.overflow = 'auto';
        popup.setAttribute('aria-hidden', 'true');
    }
    
    // Add click event to all triggers
    triggers.forEach(trigger => {
        trigger.addEventListener('click', openPopup);
        
        // Add keyboard support for button triggers
        if (trigger.tagName === 'BUTTON') {
            trigger.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    openPopup();
                }
            });
        }
    });
    
    // Close when clicking close button
    closeBtn.addEventListener('click', closePopup);
    
    // Close when clicking outside the popup content
    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            closePopup();
        }
    });
    
    // Close with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popup.style.display === 'flex') {
            closePopup();
        }
    });
    
    // Focus trap for accessibility
    popup.addEventListener('keydown', function(e) {
        if (e.key === 'Tab' && popup.style.display === 'flex') {
            const focusableElements = popup.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
            
            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    lastElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastElement) {
                    firstElement.focus();
                    e.preventDefault();
                }
            }
        }
    });
});