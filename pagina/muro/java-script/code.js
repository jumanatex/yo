

const luzi = document.querySelector('.luz');
const headeryy = document.getElementById('headery');
const icon = luzi.querySelector('i');

luzi.addEventListener('click', function(event) {
  event.preventDefault();

  if (headeryy.classList.contains('blanco')) {
    headeryy.classList.remove('blanco');
    headeryy.classList.add('rojo');
    icon.style.color = 'black';
  } else {
    headeryy.classList.remove('rojo');
    headeryy.classList.add('blanco');
    icon.style.color = 'white';
  }

  headeryy.style.backgroundColor = headeryy.classList.contains('blanco') ? ' #000000' : 'white';
});

























