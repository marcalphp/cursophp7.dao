<?php

require_once ('config.php');
//$sql = new Sql();
//$usuario = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuario);
//
//carrega um usúario pelo id
//$lane = new Usuario();
//$lane->loadByid(2);
//echo $lane;

// carrega uma lista de todos os no bd usúrio
//$lista = Usuario::getlista();
//echo json_encode($lista);

// Carrega uma lista de usúarios buscando pelo login
//$busca = Usuario::serch_busca("r");
//echo json_encode($busca);

//Carrega um usúario usando o ligin e a senha
      //  $usuario = new Usuario();
      //  $usuario->login("root", "1234");
       // echo $usuario;

// insere um nova usuario no banco 
//$aluno = new Usuario("yas", "324");
//$aluno->setDeslogin("yas");
//$aluno->setDessenha("456");

//$aluno->inserir();
  //echo $aluno;
$atualiza = new Usuario();
$atualiza->loadByid(15);
$atualiza->update("ADEV", "13");
echo $atualiza;