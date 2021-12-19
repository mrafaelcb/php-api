<?php


namespace App\Http\Controllers\Interfaces;


interface ICrud
{
    /**
     * Responsável por listar por id
     *
     * @return mixed
     */
    public function get(): mixed;

    /**
     * Responsável por deletar por id
     *
     * @return mixed
     */
    public function delete(): mixed;

    /**
     * Responsável por editar por id
     *
     * @return mixed
     */
    public function edit(): mixed;

    /**
     * Responsável por cadastrar
     *
     * @return mixed
     */
    public function save(): mixed;

    /**
     * Responsável por retornar todos os registros
     *
     * @return mixed
     */
    public function all(): mixed;
}