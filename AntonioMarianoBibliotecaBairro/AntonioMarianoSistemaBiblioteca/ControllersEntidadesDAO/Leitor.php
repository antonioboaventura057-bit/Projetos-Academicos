<?php

class Leitor{

        private $id;
        private $nomeCompleto;
        private $cpf;
        private $telefone;
        private $foto;
        private $quantidadeLivros;
        
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;        
        }

        public function getNomeCompleto(){
            return $this->nomeCompleto;
        }

        public function setNomeCompleto($nomeCompleto){
            $this->nomeCompleto = $nomeCompleto;        
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;        
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;        
        }

        public function getFoto(){
            return $this->foto;
        }

        public function setFoto($foto){
            $this->foto = $foto;        
        }

        public function getQuantidadeLivros(){
            return $this->quantidadeLivros;
        }

        public function setQuantidadeLivros($quantidadeLivros){
            $this->quantidadeLivros = $quantidadeLivros;        
        }
    }

?>