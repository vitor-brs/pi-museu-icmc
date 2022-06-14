let varIdFormNecessidade
let numNecessidade = '0'

const modalCheckboxDV = document.getElementById('flexSwitchCheckDeficienciaVisual')
const modalCheckboxDM = document.getElementById('flexSwitchCheckDeficienciaMotora')
const modalCheckboxDI = document.getElementById('flexSwitchCheckDeficienciaIntelectual')
const modalCheckboxDA = document.getElementById('flexSwitchCheckDeficienciaAuditiva')
const modalCheckboxPC = document.getElementById('flexSwitchCheckCheckedParalisiaCerebral')


function clickClassificarNecessidade(idElemt){
    varIdFormNecessidade = idElemt.id
    
    switch (idElemt.id) {
        case 'btnClassificarNecessidade1':
            getCheckBoxNecessidade('1')
            numNecessidade = '1'
            break;
        case 'btnClassificarNecessidade2':
            getCheckBoxNecessidade('2')
            numNecessidade = '2'
            break;
        case 'btnClassificarNecessidade3':
            getCheckBoxNecessidade('3')
            numNecessidade = '3'
            break;
    
        default:
            break;
    }
}

function getCheckBoxNecessidade(num) {
    const DV = 'CheckDV' + num
    const checkDV = document.getElementById(DV)
    const checkDM = document.getElementById('CheckDM' + num)
    const checkDI = document.getElementById('CheckDI' + num)
    const checkDA = document.getElementById('CheckDA' + num)
    const checkPC = document.getElementById('CheckPC' + num)

    if(checkDV.value != null && checkDV.value != ""){
        modalCheckboxDV.checked = true
    }
    if(checkDM.value != null && checkDM.value != ""){
        modalCheckboxDM.checked = true
    }
    if(checkDI.value != null && checkDI.value != ""){
        modalCheckboxDI.checked = true
    }
    if(checkDA.value != null && checkDA.value != ""){
        modalCheckboxDA.checked = true
    }
    if(checkPC.value != null && checkPC.value != ""){
        modalCheckboxPC.checked = true
    }
    

}

function setCheckBoxNecessidade(num) {
    const checkDV = document.getElementById('CheckDV' + num)
    const checkDM = document.getElementById('CheckDM' + num)
    const checkDI = document.getElementById('CheckDI' + num)
    const checkDA = document.getElementById('CheckDA' + num)
    const checkPC = document.getElementById('CheckPC' + num)


    if(modalCheckboxDV.checked){
        checkDV.value = 'checked'
        clearCheckbox()
    }
    if(modalCheckboxDM.checked){
        checkDM.value = 'checked'
        clearCheckbox()
    }
    if(modalCheckboxDI.checked){
        checkDI.value = 'checked'
        clearCheckbox()
    }
    if(modalCheckboxDA.checked){
        checkDA.value = 'checked'
        clearCheckbox()
    }
    if(modalCheckboxPC.checked){
        checkPC.value = 'checked'
        clearCheckbox()
    }

}
function clearCheckbox() {
    modalCheckboxDV.checked = false
    modalCheckboxDM.checked = false
    modalCheckboxDI.checked = false
    modalCheckboxDA.checked = false
    modalCheckboxPC.checked = false
}
// function ifNecessidadeIsNull() {
//     const textareaNecessidadeEspecial = document.getElementById('textareaNecessidadeEspecial' + numNecessidade)
//     if (textareaNecessidadeEspecial.value == null || textareaNecessidadeEspecial.value == ""){

//     }else{
//         setCheckBoxNecessidade(numNecessidade)
//     }
// }