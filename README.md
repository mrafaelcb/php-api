# PHP API

## Instalação

    composer install

## Servidor web embutido

    php -S localhost:80 -t public

# REST API

## Cadastro de usuário

### Requisição

`POST /user`

#### Json

```json
{
  "nome": "string min 10",
  "data_nascimento": "2021-12-20 00:00:01",
  "cpf": "00000000000",
  "rg": "000000",
  "telefones": [
    {
      "ddd": 62,
      "numero": 123456789
    }
  ],
  "enderecos": [
    {
      "logradouro": "string",
      "complemento": "string",
      "numero": "int",
      "cep": "12345678",
      "fk_cidade": "1"
    }
  ]
}
```

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": {
    "id": 1,
    "nome": "string min 10",
    "data_nascimento": "2021-12-20 00:00:00",
    "cpf": "00000000000",
    "rg": "000000",
    "data_criacao": "2021-12-20 19:53:00",
    "data_alteracao": "2021-12-20 19:53:00",
    "telefones": [
      {
        "id": "1",
        "ddd": "62",
        "numero": "123456789",
        "data_criacao": "2021-12-20 19:53:00",
        "data_alteracao": "2021-12-20 19:53:00",
        "fk_usuario": "1"
      }
    ],
    "enderecos": [
      {
        "id": "1",
        "logradouro": "string",
        "complemento": "string",
        "numero": "int",
        "cep": "12345678",
        "data_criacao": "2021-12-20 19:53:00",
        "data_alteracao": "2021-12-20 19:53:00",
        "fk_cidade": "1",
        "fk_usuario": "1"
      }
    ]
  }
}
```

## Retornar usuário por id

### Requisição

`GET /user`

#### Json

```json
{
  "id": 1
}
```

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": {
    "id": 1,
    "nome": "string min 10",
    "data_nascimento": "2021-12-20 00:00:00",
    "cpf": "00000000000",
    "rg": "000000",
    "data_criacao": "2021-12-20 19:53:00",
    "data_alteracao": "2021-12-20 19:53:00",
    "telefones": [
      {
        "id": "1",
        "ddd": "62",
        "numero": "123456789",
        "data_criacao": "2021-12-20 19:53:00",
        "data_alteracao": "2021-12-20 19:53:00",
        "fk_usuario": "1"
      }
    ],
    "enderecos": [
      {
        "id": "1",
        "logradouro": "string",
        "complemento": "string",
        "numero": "int",
        "cep": "12345678",
        "data_criacao": "2021-12-20 19:53:00",
        "data_alteracao": "2021-12-20 19:53:00",
        "fk_cidade": "1",
        "fk_usuario": "1"
      }
    ]
  }
}
```

## Deletar usuário por id

### Requisição

`DELETE /user`

#### Json

```json
{
  "id": 1
}
```

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": {
    "rows_affected": 1
  }
}
```

## Editar usuário por id

### Requisição

`PUT /user`

#### Json

```json
{
  "id": 1,
  "nome": "Novo Nome Usuário",
  "data_nascimento": "2021-12-20 00:00:00",
  "cpf": "00000000000",
  "rg": "000000",
  "data_criacao": "2021-12-20 19:57:10",
  "data_alteracao": "2021-12-20 19:57:10",
  "telefones": [
    {
      "id": "1",
      "ddd": "62",
      "numero": "123456789",
      "data_criacao": "2021-12-20 19:57:10",
      "data_alteracao": "2021-12-20 19:57:10",
      "fk_usuario": "1"
    }
  ],
  "enderecos": [
    {
      "id": "1",
      "logradouro": "string",
      "complemento": "string",
      "numero": "int",
      "cep": "12345678",
      "data_criacao": "2021-12-20 19:57:10",
      "data_alteracao": "2021-12-20 19:57:10",
      "fk_cidade": "1",
      "fk_usuario": "1"
    }
  ]
}
```

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": {
    "id": 1,
    "nome": "Novo Nome Usuário",
    "data_nascimento": "2021-12-20 00:00:00",
    "cpf": "00000000000",
    "rg": "000000",
    "data_criacao": "2021-12-20 19:57:10",
    "data_alteracao": "2021-12-20 22:57:49",
    "telefones": [
      {
        "id": "1",
        "ddd": "62",
        "numero": "123456789",
        "data_criacao": "2021-12-20 19:57:10",
        "data_alteracao": "2021-12-20 22:57:49",
        "fk_usuario": "1"
      }
    ],
    "enderecos": [
      {
        "id": "1",
        "logradouro": "string",
        "complemento": "string",
        "numero": "int",
        "cep": "12345678",
        "data_criacao": "2021-12-20 19:57:10",
        "data_alteracao": "2021-12-20 22:57:49",
        "fk_cidade": "1",
        "fk_usuario": "1"
      }
    ]
  }
}
```