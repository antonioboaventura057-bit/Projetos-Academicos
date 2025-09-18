<?php

class EmprestimoDevolucao{

        private $id;
        private $leitor;
        private $livro;
        private $acao;
        private $quantidadeDias;
        private $valorMulta;
        private $dataEmprestimo;
        private $prazoDevolucao;
        private $dataDevolucao;

        public function getId(){

            return $this->id;
        }

        public function setId($id){

            $this->id = $id;
        }

        public function getAcao(){

            return $this->acao;
        }

        public function setAcao($acao){

            $this->acao = $acao;
        }

        public function getQuantidadeDias(){

            return $this->quantidadeDias;
        }

        public function setQuantidadeDias($quantidadeDias){

            $this->quantidadeDias = $quantidadeDias;
        }

        public function getValorMulta(){

            return $this->valorMulta;
        }

        public function setValorMulta($valorMulta){

            $this->valorMulta = $valorMulta;
        }

        public function getDataEmprestimo(){

            return $this->dataEmprestimo;
        }

        public function setDataEmprestimo($dataEmprestimo){

            $this->dataEmprestimo = $dataEmprestimo;
        }

        public function getPrazoDevolucao(){

            return $this->prazoDevolucao;
        }

        public function setPrazoDevolucao($prazoDevolucao){

            $this->prazoDevolucao = $prazoDevolucao;
        }

        public function getDataDevolucao(){

            return $this->dataDevolucao;
        }

        public function setDataDevolucao($dataDevolucao){

            $this->dataDevolucao = $dataDevolucao;
        }

        public function getLivro(){

            return $this->livro;
        }

        public function setLivro($livro){

            $this->livro = $livro;
        }

        public function getLeitor(){

            return $this->leitor;
        }

        public function setLeitor($leitor){

            $this->leitor = $leitor;
        }

    }

?>