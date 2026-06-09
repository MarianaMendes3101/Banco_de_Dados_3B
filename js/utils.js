document.addEventListener('DOMContentLoaded',()=>{
    const from = document.querySelector('form');
    const campoCep = document.querySelector('#cep');
    const senha = document.querySelector('#senha');
    const confirma = document.querySelector('#confirma_senha');
    const btnSalvar = document.querySelector('#btnGravar');


    //Máscara dinamica
    document.querySelectorAll('[data-mascara]').forEach(input =>{
        input.addEventListener('input',(e)=>{
            const padrao = e.target.dataset.mascara;
            let valor = e.target.value.replace(/\D/g, '');
            let res = "", idx = 0;
            for (let i = 0; i < padrao.length && idx < valor.length; 
                i++){
                    res += padrao [i] === '0' ? valor[idx++] : padrao[i];
           }
           e.target.value = res;
        })

    });

    //Busca de Cep automática (viaCep)

    if (campoCep) {
        campoCep.addEventListener('blur', async () => {
            let cep = campoCep.value.replace(/\D/g, '');
            if (cep.length !== 8) return;

            try {
                const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                const dados = await res.json();
                if (!dados.erro) {
                    document.querySelector('#logradouro').value = dados.logradouro;
                    document.querySelector('#bairro').value = dados.bairro;
                    document.querySelector('#cidade').value = dados.localidade;
                    document.querySelector('#estado').value = dados.uf;
                }
            } catch (erro) {
                console.error("Falha na requisição de endereço: ", erro);
            }
        });
    }

    if(senha && confirma && btnSalavr){
        const configurarToggleSenha = (btnId, inputId) => {
            const btn = document.querySelector(btnId);
            if(!btn) return;
            const input = document.querySelector(inputId);
            const icone = btn.querySelector('i');
            btn.addEventListener('click', ()=>{
            const tipo = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', tipo);
            icone.classList.toggle('bi-eye');
            icone.classList.toggle('bi-eye-slash');
            });
        };
        configurarToggleSenha('toggleSenha', 'senha');
        configurarToggleSenha('toggleConfirmaSenha', '#confirma_senha');

        const validar = ()=>{
            const erro = senha.value ==="" || senha.value !== confirma.value;
            confirma.style.borderColor = erro ? 'red' : 'green';
            btnSalvar.disabled = erro;
        };
        senha.addEventListener('input', validar);
        confirma.addEventListener('input', validar);        
    }

    const alerta = document.querySelector('#msgAlerta');
    if(alerta){
        setTimeout(()=> {
            const bsAlerta = new bootstrap.Alert(alerta);
            bsAlerta.close();
        }, 4000);
    }
});