const addOrg = document.getElementById('group-select')
const othersOrg = document.getElementById('others-org')

addOrg.addEventListener('change', (ev) => {
    const tagValue = '<input id="otherOrg" class="form-control mb-2" type="text" placeholder="Informe o tipo da sua organização" required>'
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

const dataVisita = document.getElementById('initial-date')
const addHora = document.getElementById('horario-visita')
dataVisita.addEventListener('change',(ev) => {
    const diaDaSemana = new Date(dataVisita.value)
    const dia = diaDaSemana.getDay()
    if(dia == 6 || dia == 5){
        $("#modal-invalid-day").modal('show')
        dataVisita.value = ""
        addHora.innerHTML = ''
    }else{
        addHora.innerHTML = '<span>Escolha um horário</span>'
    }
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

const addDate = document.getElementById('btn-add-date')
const removeDate = document.getElementById('btn-remove-date')
const segundaVisita = document.getElementById('segunda-visita')

const strNecessidadeEspecial = '<section class="mb-3"><h5 class="fonts-custom fs-5">Dados da próxima visita</h5><div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="flexSwitch-especial" /><label class="form-check-label" for="flexSwitch-especial">Possui necessidade especial? </label></div><textarea id="tipo-necessidade" class="form-control" aria-label="With textarea" placeholder="Indique qual" disabled required></textarea></section>';

addDate.addEventListener('click', (ev)  =>{
        segundaVisita.innerHTML = strNecessidadeEspecial + '<span>Escolha uma data</span><input class="form-control" type="date" id="initial-date" required/><span>Informe o número de visitantes</span><input class="form-control mb-2" type="number" id="initial-visitor" required/>';
        removeDate.toggleAttribute('hidden');
        addDate.toggleAttribute('hidden');
});
removeDate.addEventListener('click', (ev) => {
    segundaVisita.innerHTML = "";
    removeDate.toggleAttribute('hidden');
    addDate.toggleAttribute('hidden');
});

const isValidPhone = (phone) => {
    const phonenumber = phone.replace(/\D/g,'');
    return phonenumber.length >= 10 && phonenumber.length <= 11;
};
const phonenumberTag = document.getElementById('phonenumber')
phonenumberTag.addEventListener('blur',(ev)=>{
    console.log(isValidPhone(phonenumberTag.value))
    const number = isValidPhone(phonenumberTag.value)
    if ((phonenumberTag.value != "") && (number < 10 || number > 11) ) {
        $("#modal-invalid-phonenumber").modal('show')
        phonenumberTag.value = ""
    }
});