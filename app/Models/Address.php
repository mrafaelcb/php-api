<?php

namespace App\Models;

use App\Util\Utils;
use DateTime;
use Exception;

class Address extends AbstractModel
{
    private ?int $id;
    private string $logradouro;
    private string $complemento;
    private string $numero;
    private string $cep;
    private ?DateTime $dataCriacao;
    private ?DateTime $dataAlteracao;
    private ?int $fkCidade;
    private ?int $fkUsuario;

    /**
     * User constructor.
     *
     * @throws Exception
     */
    public function __construct($data = null)
    {
        if ($data != null) {
            $this->id = Utils::getValue('id', $data);
            $this->logradouro = Utils::getValue('logradouro', $data);
            $this->complemento = Utils::getValue('complemento', $data);
            $this->numero = Utils::getValue('numero', $data);
            $this->cep = Utils::getValue('cep', $data);
            $this->dataCriacao = Utils::getValueDate('data_criacao', $data);
            $this->dataAlteracao = Utils::getValueDate('data_alteracao', $data);
            $this->fkCidade = Utils::getValue('fk_cidade', $data);
            $this->fkUsuario = Utils::getValue('fk_usuario', $data);
        }
    }

    /**
     * @return int|mixed|null
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param int|mixed|null $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getLogradouro(): mixed
    {
        return $this->logradouro;
    }

    /**
     * @param mixed|string $logradouro
     */
    public function setLogradouro(mixed $logradouro): void
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed|string
     */
    public function getComplemento(): mixed
    {
        return $this->complemento;
    }

    /**
     * @param mixed|string $complemento
     */
    public function setComplemento(mixed $complemento): void
    {
        $this->complemento = $complemento;
    }

    /**
     * @return mixed|string
     */
    public function getNumero(): mixed
    {
        return $this->numero;
    }

    /**
     * @param mixed|string $numero
     */
    public function setNumero(mixed $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed|string
     */
    public function getCep(): mixed
    {
        return $this->cep;
    }

    /**
     * @param mixed|string $cep
     */
    public function setCep(mixed $cep): void
    {
        $this->cep = $cep;
    }

    /**
     * @return DateTime|mixed|null
     */
    public function getDataCriacao(): mixed
    {
        return $this->dataCriacao;
    }

    /**
     * @param DateTime|mixed|null $dataCriacao
     */
    public function setDataCriacao(mixed $dataCriacao): void
    {
        $this->dataCriacao = $dataCriacao;
    }

    /**
     * @return DateTime|mixed|null
     */
    public function getDataAlteracao(): mixed
    {
        return $this->dataAlteracao;
    }

    /**
     * @param DateTime|mixed|null $dataAlteracao
     */
    public function setDataAlteracao(mixed $dataAlteracao): void
    {
        $this->dataAlteracao = $dataAlteracao;
    }

    /**
     * @return int|mixed|null
     */
    public function getFkCidade(): mixed
    {
        return $this->fkCidade;
    }

    /**
     * @param int|mixed|null $fkCidade
     */
    public function setFkCidade(mixed $fkCidade): void
    {
        $this->fkCidade = $fkCidade;
    }

    /**
     * @return int|mixed|null
     */
    public function getFkUsuario(): mixed
    {
        return $this->fkUsuario;
    }

    /**
     * @param int|mixed|null $fkUsuario
     */
    public function setFkUsuario(mixed $fkUsuario): void
    {
        $this->fkUsuario = $fkUsuario;
    }
}