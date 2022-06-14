const divAgenda = document.getElementById('agenda')
const divRelatorios = document.getElementById('relatorios')
const divVisitantes = document.getElementById('visitantes')

function openNav() {
    document.getElementById("sidebarMenu").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}
  
function closeNav() {
    document.getElementById("sidebarMenu").style.width = "55px";
    document.getElementById("main").style.marginLeft = "0px";
}

function closeNavSmall() {
    document.getElementById("sidebarMenu").style.width = "0px";
    document.getElementById("main").style.marginLeft = "0px";
}

const btnMenu = document.getElementById('btnMenuExpand')
const menu = document.getElementById('sidebarMenu')

btnMenu.addEventListener('click', ()=>{
    console.log(window.screen.width)
    if (window.screen.width <= 420 && window.screen.height <= 920) {
        if (menu.style.width == "250px") {
            closeNavSmall()
        }else{
            openNav()
            
        }
    }else{
        if (menu.style.width == "250px") {
            closeNav()
        }else{
            openNav()
        }
    }
    
    
    
});
