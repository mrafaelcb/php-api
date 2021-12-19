<?php

namespace App\Models;

use App\Util\Utils;
use DateTime;
use Exception;

class User extends AbstractModel
{
    private ?int $id;
    private string $nome;
    private ?DateTime $dataNascimento;
    private string $cpf;
    private string $rg;
    private ?DateTime $dataCriacao;
    private ?DateTime $dataAlteracao;
    private ?array $telefones = [];

    /**
     * User constructor.
     *
     * @throws Exception
     */
    public function __construct($data = null)
    {
        if ($data != null) {
            $this->id = Utils::getValue('id', $data);
            $this->nome = Utils::getValue('nome', $data);
            $this->dataNascimento = Utils::getValueDate('data_nascimento', $data);
            $this->cpf = Utils::getValue('cpf', $data);
            $this->rg = Utils::getValue('rg', $data);
            $this->dataCriacao = Utils::getValueDate('data_criacao', $data);
            $this->dataAlteracao = Utils::getValueDate('data_alteracao', $data);
            $this->telefones = Utils::getValue('telefones', $data);
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return DateTime
     */
    public function getDataNascimento(): DateTime
    {
        return $this->dataNascimento;
    }

    /**
     * @param DateTime $dataNascimento
     */
    public function setDataNascimento(DateTime $dataNascimento): void
    {
        $this->dataNascimento = $dataNascimento;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getRg(): string
    {
        return $this->rg;
    }

    /**
     * @param string $rg
     */
    public function setRg(string $rg): void
    {
        $this->rg = $rg;
    }

    /**
     * @return DateTime
     */
    public function getDataCriacao(): DateTime
    {
        return $this->dataCriacao;
    }

    /**
     * @param DateTime $dataCriacao
     */
    public function setDataCriacao(DateTime $dataCriacao): void
    {
        $this->dataCriacao = $dataCriacao;
    }

    /**
     * @return DateTime
     */
    public function getDataAlteracao(): DateTime
    {
        return $this->dataAlteracao;
    }

    /**
     * @param DateTime $dataAlteracao
     */
    public function setDataAlteracao(DateTime $dataAlteracao): void
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return array
     */
    public function getTelefones(): array
    {
        return !is_null($this->telefones) ? $this->telefones : [];
    }

    /**
     * @param array $telefones
     */
    public function setTelefones(array $telefones): void
    {
        $this->telefones = $telefones;
    }
}