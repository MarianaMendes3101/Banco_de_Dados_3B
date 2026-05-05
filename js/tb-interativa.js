class TabelaInterativa{
    #config;
    #tabela;
    #corpoTabela;
    #campoFiltro;

    constructor(config){
        this.#config = config;
    }

    iniciar(){
        this.#tabela = document.getElementById(this.#config.tabelaId);
        this.#campoFiltro = document.getElementById(this.#config.filtroId);
        this.#corpoTabela = this.#tabela.querySelector("tbody");

        this.#campoFiltro.addEventLister("input", ()=>{
            this.#filtrar();
        });        
    }

    #filtrar(){
        const termo = this.#campoFiltro.value.toLowerCase();
        const linhas = this.#corpoTabela.querySelectorALL("tr");
        
        linhas.forEach((linha)=>{
            let texto;
        });
    }
}