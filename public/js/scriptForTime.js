// Function to update the date and time display
function updateDateTime() {
    const now = new Date();
    
    // Format time
    const timeString = now.toLocaleTimeString();
    document.getElementById('real-time-display').textContent = timeString;
    
    // Format date
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = now.toLocaleDateString(undefined, options);
    document.getElementById('current-date').textContent = dateString;
}

// Update date and time immediately and then every second
updateDateTime();
setInterval(updateDateTime, 1000);