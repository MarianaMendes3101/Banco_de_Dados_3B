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

});
