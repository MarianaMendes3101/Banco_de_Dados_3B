document.addEventListener('DOMContentLoaded',()=>{
    const tabela = new TabelaInterativa({
        tabelaId: 'tabela-exercicios',
        filtroId: 'campo-filtro',
    });
    tabela.iniciar();
});