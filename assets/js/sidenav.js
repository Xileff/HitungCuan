const sidebar = document.getElementById('lesson-side-bar')
const spanToggleMateri = document.getElementById('spanToggleMateri')
const navbar = document.getElementsByTagName('nav')[0]
const overlay = document.getElementsByClassName('overlay')[0]

function showLessons(){
    sidebar.classList.toggle('sidebar-hide');
    spanToggleMateri.classList.toggle('hide');
    overlay.classList.toggle('d-none');
    navbar.classList.toggle('fadeup');
}