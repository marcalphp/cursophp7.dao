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
            $this->setData($resulte[0]);
            // $row = $resulte[0];
            //$this->setIdusuario($row ['idusuario']);
            //$this->setDeslogin($row ['deslogin']);
            //$this->setDessenha($row ['dessenha']);
            //$this->setDtcadastro(new DateTime($row ['dtcadastro']));
        }
    }

    public static function getLista() {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios  ORDER BY deslogin");
    }

    public static function serch_busca($login) {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH  ORDER BY deslogin", array(
                    ':SEARCH' => "%" . $login . "%"
        ));
    }

    public function login($login, $senha) {
        $sql = new Sql();
        $resulte = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :senha", array(
            ":LOGIN" => $login,
            ":senha" => $senha
        ));
        if (isset($resulte[0])) {
            //  $row = $resulte[0];
            //$this->setIdusuario($row ['idusuario']);
            // $this->setDeslogin($row ['deslogin']);
            //$this->setDessenha($row ['dessenha']);
            //$this->setDtcadastro(new DateTime($row ['dtcadastro']));
            $this->setData($resulte[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos.");
        }
    }

    public function setData($dato) {

        $this->setIdusuario($dato ['idusuario']);
        $this->setDeslogin($dato ['deslogin']);
        $this->setDessenha($dato['dessenha']);
        $this->setDtcadastro(new DateTime($dato['dtcadastro']));
    }

    public function inserir() {
        $sql = new Sql();
        $result = $sql->select("CALL sp_usuario_insert(:LOGIN, :SENHA)", array(
            ':LOGIN' => $this->getDeslogin(),
            ':SENHA' => $this->getDessenha()
        ));
        if (isset($result[0])) {
            $this->setData($result[0]);
        }
    }

    public function __construct($login = "", $senha = "") {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }

    public function update($login, $senha) {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
        $sql = new Sql();
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
            ':LOGIN' => $this->getDeslogin(),
            ':SENHA' => $this->getDessenha(),
            ':ID' => $this->getIdusuario()
        ));
    }

    public function delate() {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ':ID' => $this->getIdusuario()
        ));
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
       $this->setDtcadastro(new DateTime());
    }

    public function __toString() {

        return json_encode(array(
            "idusuario" => $this->getIdusuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastra" => $this->getDtcadastro()->format("d/m/y H:i:s")
        ));
    }

}
