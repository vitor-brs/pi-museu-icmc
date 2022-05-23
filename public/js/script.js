const addOrg = document.getElementById('group-select')
const othersOrg = document.getElementById('others-org')

addOrg.addEventListener('change', (ev) => {
    const tagValue = '<input id="otherOrg" class="form-control mb-2" type="text" aria-label="Outro tipo de organização" placeholder="Informe o tipo da sua organização" required>'
    const textOthersOrg = document.getElementById('otherOrg');
    if (typeof(textOthersOrg) != 'undefined' && textOthersOrg != null){
        addOrg.focus()
        if(addOrg.value != 'Outros'){
            othersOrg.innerHTML = ''
        }
    }else if(addOrg.value == 'Outros'){
        othersOrg.innerHTML = tagValue;
        const textOthersOrg = document.getElementById('otherOrg');
        textOthersOrg.focus()
    }
})

$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
                        // $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        // alert("CEP não encontrado.");
                        $("#modal-cep-not-found").modal('show');

                       
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                // alert("Formato de CEP inválido.");
                $("#modal-invalid-cep").modal('show');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

const checkNecessidadeEspecial = document.getElementById('flexSwitch-especial')
const textNecessidadeEspecial = document.getElementById('tipo-necessidade')
checkNecessidadeEspecial.addEventListener('click', (ev) => {
        textNecessidadeEspecial.toggleAttribute('disabled')
        textNecessidadeEspecial.value = ''
        textNecessidadeEspecial.focus()
});

function validacaoEmail(field) {
    usuario = field.value.substring(0, field.value.indexOf("@"));
    dominio = field.value.substring(field.value.indexOf("@")+ 1, field.value.length);
    
    if ((usuario.length >=1) &&
        (dominio.length >=3) &&
        (usuario.search("@")==-1) &&
        (dominio.search("@")==-1) &&
        (usuario.search(" ")==-1) &&
        (dominio.search(" ")==-1) &&
        (dominio.search(".")!=-1) &&
        (dominio.indexOf(".") >=1)&&
        (dominio.lastIndexOf(".") < dominio.length - 1)) {
    
        //  alert("E-mail valido");
        return true
    }
    else{
    return false
    // alert("E-mail invalido");
    }
}

const inputEmail = document.getElementById('email')
inputEmail.addEventListener('blur', (ev)=>{
    if((inputEmail.value != "") && (validacaoEmail(inputEmail) == false)){
        $("#modal-invalid-email").modal('show')
        inputEmail.value = ""
    }
});

const btnAddDate = document.getElementById('btn-add-date')
const btnRemoveDate = document.getElementById('btn-remove-date')
const segundaVisita = document.getElementById('segunda-visita')
const terceiraVisita = document.getElementById('terceira-visita')

let numeroVisita = 0;
btnAddDate.addEventListener('click', (ev)  =>{
        numeroVisita++;
        if (numeroVisita == 1) {
            segundaVisita.innerHTML = addVisita('2', 'Dados da segunda visita');
            btnRemoveDate.toggleAttribute('hidden');
        }
        if (numeroVisita == 2) {
            terceiraVisita.innerHTML = addVisita('3', 'Dados da última visita');
            btnAddDate.toggleAttribute('hidden');
        }
        
});
btnRemoveDate.addEventListener('click', (ev) => {
    
    if (numeroVisita == 1) {
        segundaVisita.innerHTML = "";
        btnRemoveDate.toggleAttribute('hidden');
        numeroVisita--;
    }
    if (numeroVisita == 2) {
            terceiraVisita.innerHTML = "";
            btnAddDate.toggleAttribute('hidden');
            numeroVisita--;
    }
});

const isValidPhone = (phone) => {
    const phonenumber = phone.replace(/\D/g,'');
    return phonenumber.length >= 10 && phonenumber.length <= 11;
};
const phonenumberTag = document.getElementById('phonenumber')
phonenumberTag.addEventListener('blur',(ev)=>{
    
    const number = isValidPhone(phonenumberTag.value)
    // if ((phonenumberTag.value != "") && (number < 10 || number > 11) ) {
    if ((phonenumberTag.value != "") && (number == false ) ) {
        $("#modal-invalid-phonenumber").modal('show')
        phonenumberTag.value = ""
    }
});

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function mtel(v){
    v=v.replace(/\D/g,""); //Remove tudo o que não é dígito
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d)(\d{4})$/,"$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id( el ){
	return document.getElementById( el );
}
window.onload = function(){
	id('phonenumber').onkeyup = function(){
		mascara( this, mtel );
	}
}

function addVisita(visita, texto) {
    const addHeaderVisita = '<section class="mb-3"><h5 class="fonts-custom fs-5">'+ texto +'</h5>'
    const addNecessidadeEspecial = '<div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="flexSwitch-especial'+ visita +'" name="n_especial'+ visita +'" onclick=" onNecessidadeEspecial(' + visita + ') "/><label class="form-check-label" for="flexSwitch-especial'+ visita +'">Possui necessidade especial? </label></div><textarea id="tipo-necessidade'+ visita +'" name="q_especial'+ visita +'" class="form-control" aria-label="Indique qual sua necessidade especial" placeholder="Indique qual" disabled required></textarea>'
    const addDataVisita = '<span>Escolha uma data</span><input class="form-control" type="date" onchange="validaData(' + visita +')" id="initial-date' + visita + '" name="data'+ visita +'" required/><span>Informe o número de visitantes</span><input class="form-control mb-2" type="number" id="initial-visitor'+ visita +'" name="visitante'+ visita +'" required/> </section>'

    return addHeaderVisita + addNecessidadeEspecial + addDataVisita
}
function onNecessidadeEspecial(params) {
    // const checkNecessidadeEspecial = document.getElementById('flexSwitch-especial' + params)
        const textareaNecessidadeEspecial = document.getElementById('tipo-necessidade' + params)
        textareaNecessidadeEspecial.toggleAttribute('disabled')
        textareaNecessidadeEspecial.value = ''
        textareaNecessidadeEspecial.focus()
}


const dataVisita1 = document.getElementById('initial-date')
const todayDate = new Date();
// let day = todayDate.getDate();
dataVisita1.addEventListener('change',(ev) => {
    validaData('')
});

function validaData(params) {
    const dataVisita = document.getElementById('initial-date'+params)
    const diaDaSemana = new Date('"'+ dataVisita.value +'"')
    const dia = diaDaSemana.getDay()
    if(dia == 6 || dia == 0){
        $("#modal-invalid-day").modal('show')
        dataVisita.value = ""
    }

    if((diaDaSemana < todayDate) && (dia != 6 || dia != 5)){
        $("#modal-error-day").modal('show')
        dataVisita.value = ""
    }
}