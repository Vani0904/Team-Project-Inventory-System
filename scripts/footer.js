function loadFooter() {
    fetch('footer.html')
      .then(response => response.text())
      .then(data => {
        const footer = document.createElement('footer');
        footer.innerHTML = data;
        document.body.appendChild(footer);
      });
  }
  

  window.onload = loadFooter;