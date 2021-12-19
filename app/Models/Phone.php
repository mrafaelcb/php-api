<?php

namespace App\Models;

use App\Util\Utils;
use DateTime;
use Exception;

class Phone extends AbstractModel
{
    private ?int $id;
    private string $ddd;
    private string $numero;
    private ?DateTime $dataCriacao;
    private ?DateTime $dataAlteracao;
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
            $this->ddd = Utils::getValue('ddd', $data);
            $this->numero = Utils::getValue('numero', $data);
            $this->dataCriacao = Utils::getValueDate('data_criacao', $data);
            $this->dataAlteracao = Utils::getValueDate('data_alteracao', $data);
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
    public function getDdd(): mixed
    {
        return $this->ddd;
    }

    /**
     * @param mixed|string $ddd
     */
    public function setDdd(mixed $ddd): void
    {
        $this->ddd = $ddd;
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
     * @return int|mixed
     */
    public function getFkUsuario(): mixed
    {
        return $this->fkUsuario;
    }

    /**
     * @param int|mixed $fkUsuario
     */
    public function setFkUsuario(mixed $fkUsuario): void
    {
        $this->fkUsuario = $fkUsuario;
    }
}