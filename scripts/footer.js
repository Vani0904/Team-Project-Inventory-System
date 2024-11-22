// footer.js
function loadFooter() {
    const footer = document.createElement('footer');
    footer.innerHTML = `
      <p>&copy; 2024</p>
    `;
    document.body.appendChild(footer);
  }
  
  // Call the function to load the footer
  window.onload = loadFooter;