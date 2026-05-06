<?php

spl_autoload_register(function ($class) {
    require_once "class/{$class}.class.php";
});

$exercicio = new Exercicio();

if (filter_has_var(INPUT_POST,"btnGravar")) {
    $exercicio->setNome(filter_input(INPUT_POST,"nome", FILTER_SANITIZE_STRING));
    $exercicio->setDescricao(filter_input(INPUT_POST,"descricao", FILTER_SANITIZE_STRING));
    $exercicio->setGrupoMuscular(filter_input(INPUT_POST,"grupoMuscular", FILTER_SANITIZE_STRING));

    if($exercicio->add()){
        header("Location:exercicios.php");
    }
    
}