<?php

class Livro{

        private $id;
        private $nome;
        private $estilo;
        private $disponivel;

        public function getId(){

            return $this->id;
        }

        public function setId($id){

            $this->id = $id;
        }

        public function getNome(){

            return $this->nome;
        }

        public function setNome($nome){

            $this->nome = $nome;
        }

        public function getEstilo(){

            return $this->estilo;
        }

        public function setEstilo($estilo){

            $this->estilo = $estilo;
        }

        public function getDisponivel(){

            return $this->disponivel;
        }

        public function setDisponivel($disponivel){

            $this->disponivel = $disponivel;
        }

    }

?>