<?php
namespace Concessionaria\Projetob\Controller;

class Principal
{
     private \Twig\Environment $ambiente;
     private \Twig\Loader\FilesystemLoader $carregador;

     public function __construct()
     {
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");
 
        $this->ambiente = new \Twig\Environment($this->carregador);
     }  

     public function inicio()
    {
        echo $this->ambiente->render("inicio.html");
    }

    public function veiculos()
    {
        echo $this->ambiente->render("veiculos/index.html");
    }
}
?>