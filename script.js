window.addEventListener('DOMContentLoaded', function() {

      let nombre = localStorage.getItem('numeroUtilisateur');
      
      if(!nombre) {
        nombre = Math.floor(Math.random() * 10001); 
        localStorage.setItem('numeroUtilisateur', nombre);
      }

      document.getElementById('resultat').textContent = "Ton numero est : " + nombre;

    });