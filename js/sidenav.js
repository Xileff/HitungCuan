function openNav() {
    const width = window.innerWidth;
    const sideNav = document.getElementById("mySideNav");
    const main = document.getElementById("main");
    
    const veryWide = "25%";
    const wide = "250px";
    const medium = "250px";
    const full = "100%";

    if(width >= 992){
        sideNav.style.width =  veryWide;
        main.style.marginLeft =  veryWide;
    }
    else if(width >= 768) {
        sideNav.style.width =  wide;
        main.style.marginLeft =  wide;
    }
    else if(width >= 576) {
        sideNav.style.width =  medium;
        main.style.marginLeft =  medium;
    }
    else if(width < 576) {
        sideNav.style.width =  full;
    }

    const lessons = sideNav.querySelectorAll("a");

    let i = 0;
    while(i < lessons.length){
        lessons[i].style.display = "block";
        i++;
    }
}

function closeNav() {
    const width = window.innerWidth;
    const sideNav = document.getElementById("mySideNav");
    const main = document.getElementById("main");
    sideNav.style.width = "0";
    main.style.marginLeft = "0";
}