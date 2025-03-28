<?php

namespace App\DTO;

class LibroDTO {
    public $titulo;
    public $autor;
    public $genero;
    public $disponible;

    public function __construct($titulo, $autor, $genero, $disponible) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->genero = $genero;
        $this->setDisponible($disponible);

    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor($autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     */
    public function setGenero($genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of disponible
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set the value of disponible
     */
    public function setDisponible($disponible): self
    {
        if($disponible == 0){
            $this->disponible = false;
        } elseif($disponible == 1){
            $this->disponible = true;
        } else{
            $this->disponible = $disponible;
        }
        
        return $this;
    }
}
?>