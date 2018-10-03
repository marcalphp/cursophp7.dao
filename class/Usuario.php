<?php

class Usuario {

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    function getIdusuario() {
        return $this->idusuario;
    }

    function getDeslogin() {
        return $this->deslogin;
    }

    function getDessenha() {
        return $this->dessenha;
    }

    function getDtcadastro() {
        return $this->dtcadastro;
    }

    function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    function setDeslogin($deslogin) {
        $this->deslogin = $deslogin;
    }

    function setDessenha($dessenha) {
        $this->dessenha = $dessenha;
    }

    function setDtcadastro($dtcadastro) {
        $this->dtcadastro = $dtcadastro;
    }

    public function loadByid($id) {
        $sql = new Sql();
        $resulte = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID" => $id
        ));
        if (isset($resulte[0])) {
            $row = $resulte[0];
            $this->setIdusuario($row ['idusuario']);
            $this->setDeslogin($row ['deslogin']);
            $this->setDessenha($row ['dessenha']);
            $this->setDtcadastro(new DateTime($row ['dtcadastro']));
        }
    }
    public static function getLista(){
        $sql =new Sql();
        return $sql->select("SELECT * FROM tb_usuarios  ORDER BY deslogin");
    }
    
      public static function serch_busca($login){
        $sql =new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH  ORDER BY deslogin", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }
    public  function login($login, $senha){
      $sql = new Sql();
        $resulte = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :senha", array(
            ":LOGIN" => $login,
            ":senha"=>$senha
        ));
        if (isset($resulte[0])) {
            $row = $resulte[0];
            $this->setIdusuario($row ['idusuario']);
            $this->setDeslogin($row ['deslogin']);
            $this->setDessenha($row ['dessenha']);
            $this->setDtcadastro(new DateTime($row ['dtcadastro']));
        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }
    

    public function __toString() {
        return json_encode(array(
            "idusuario"=> $this->getIdusuario(),
            "deslogin"=> $this->getDeslogin(),
            "dessenha"=> $this->getDessenha(),
            "dtcadastra"=> $this->getDtcadastro()->format("d/m/y H:i:s")
        ));
    }
}
