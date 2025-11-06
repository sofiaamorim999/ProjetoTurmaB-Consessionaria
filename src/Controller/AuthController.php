<?php

    namespace Concessionaria\Projetob\Controller;
    use PDO;
    use Concessionaria\Projetob\Model\Usuario;

    class AuthController
{

    private \Twig\Environment $ambiente;
    private \Twig\Loader\FilesystemLoader $carregador;

     public function __construct()
     {
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View/auth");
 
        $this->ambiente = new \Twig\Environment($this->carregador);

     }  

    public function showRegisterForm(){
       echo $this->ambiente->render("register.html");
    }

    public function register(){
        $nome = $_POST['Nome_Usuario'] ?? '';
        $email = $_POST['Email_Usuario'] ?? '';
        $senha = $_POST['Senha_Usuario'] ?? '';

    if (empty($nome) || empty($email) || empty($senha)) {
        echo "Preencha todos os campos.";
        return;
    }

     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido.";
        return;
    }

    $conexao = new \PDO("mysql:host=localhost;dbname=PRJ2DS", "Aluno2DS", "SenhaBD2");

    $user = new Usuario($conexao);

    if ($user->existeEmail($email)) {
        echo "E-mail já cadastrado";
        return;
    }

    if ($user->criar($nome, $email, $senha)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}

    public function showLoginForm(){
       echo $this->ambiente->render("login.html");
    }

     public function Logout(){
        session_start();
        session_destroy();
        header("Location: login.html");
        exit;
     }
    
    public function is_logged_in(){
        if(isset($_SESSION["user_id"])){
            return true;
        } else{
            return false;
        }
     }

    public function auth_middleware(){
        if(false === $this->is_logged_in()){
            header("Location: login.html");
            exit;
        } else{
            header("Location: inicio.html");
            exit;
        }
     }
}
?>