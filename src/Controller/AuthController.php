<?php
    namespace Concessionaria\Projetob\Controller;

    class AuthController
{
     private \Twig\Environment $ambiente;
     private \Twig\Loader\FilesystemLoader $carregador;

     public function __construct()
     {
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
 
        $this->ambiente = new \Twig\Environment($this->carregador);

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