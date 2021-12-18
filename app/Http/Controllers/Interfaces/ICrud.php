<?php


namespace App\Http\Controllers\Interfaces;


interface ICrud
{
    /**
     * Responsável por listar por id
     *
     * @param $id
     * @return mixed
     */
    public function get($id): mixed;

    /**
     * Responsável por deletar por id
     *
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed;

    /**
     * Responsável por editar por id
     *
     * @param $id
     * @return mixed
     */
    public function edit($id): mixed;

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