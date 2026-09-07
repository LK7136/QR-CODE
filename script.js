window.addEventListener('DOMContentLoaded', function() {
      const nombre = Math.floor(Math.random() * 10001); 
      document.getElementById('resultat').textContent = 
        "Ton numero est : " + nombre;
    });