document.querySelectorAll('.our-p-products li').forEach(item => {
  item.addEventListener('click', () => {
      const filter = item.getAttribute('data-filter');
      window.location.href = `?filter=${filter}`;
  });
   
  
});
