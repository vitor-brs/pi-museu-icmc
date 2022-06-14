let getIdBtnStatus
function clickStatus(idBtn){
    
   return getIdBtnStatus = idBtn.id;
    
}
function changeStatus(params, liStatusList) {
    // const status = document.getElementById()
    const el = document.getElementById(params)
    el.innerHTML = liStatusList
    el.value = liStatusList
    
    switch (liStatusList) {
        case 'Agendado':

            remove(el)
            el.classList.add('badge-secondary')
            break;
        case 'Confirmado':
            remove(el)
            el.classList.add('badge-primary')
            break;
        case 'Concluído':
            remove(el)
            el.classList.add('badge-success')
            break;
        case 'Faltou':
            remove(el)
            el.classList.add('badge-warning')
            break;
        case 'Cancelado':
            remove(el)
            el.classList.add('badge-danger')
            break;
        default:
            break;
    }
}

function remove(el) {
    el.classList.remove('badge-secondary')
    el.classList.remove('badge-primary')
    el.classList.remove('badge-success')
    el.classList.remove('badge-warning')
    el.classList.remove('badge-danger')
}
