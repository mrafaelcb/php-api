# PHP API

## Instalação

    composer install

## Servidor web embutido

    php -S localhost:80 -t public

## Postman collection

    https://www.getpostman.com/collections/621fcbbcd5577aa3de78

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
  "password": "123456",
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

## Retornar usuário logado

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
    "nome": "Novo Nome Usuário",
    "data_nascimento": "2021-12-20 00:00:00",
    "cpf": "00000000000",
    "rg": "000000",
    "password": "$2y$10$dQ9aoIX5xr2Sia5lGrjOw.s9qeGsGsSwh9kBIZDOjX9PjO3ub8hmu",
    "data_criacao": "2021-12-20 19:57:10",
    "data_alteracao": "2021-12-21 00:30:24",
    "telefones": [
      {
        "id": "1",
        "ddd": "62",
        "numero": "123456789",
        "data_criacao": "2021-12-20 19:57:10",
        "data_alteracao": "2021-12-21 00:30:24",
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
        "data_alteracao": "2021-12-21 00:30:24",
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
    "password": "$2y$10$/3X3lJu7qlhvD19VnlrnV.2PCmsdutCzx9mxORwd1.VnUVFs9.vwy",
    "data_criacao": "2021-12-20 19:57:10",
    "data_alteracao": "2021-12-21 01:02:16",
    "telefones": [
      {
        "id": "1",
        "ddd": "62",
        "numero": "123456789",
        "data_criacao": "2021-12-20 19:57:10",
        "data_alteracao": "2021-12-21 01:02:16",
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
        "data_alteracao": "2021-12-21 01:02:17",
        "fk_cidade": "1",
        "fk_usuario": "1"
      }
    ]
  }
}
```

## Listar Usuários

### Requisição

`GET /users`

#### Json

```json
{
  "page": 1,
  "per_page": 5
}
```

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": [
    {
      "id": 1,
      "nome": "Novo Nome Usuário",
      "data_nascimento": "2021-12-20 00:00:00",
      "cpf": "00000000000",
      "rg": "000000",
      "password": "$2y$10$/3X3lJu7qlhvD19VnlrnV.2PCmsdutCzx9mxORwd1.VnUVFs9.vwy",
      "data_criacao": "2021-12-20 19:57:10",
      "data_alteracao": "2021-12-21 01:02:16",
      "telefones": [
        {
          "id": "1",
          "ddd": "62",
          "numero": "123456789",
          "data_criacao": "2021-12-20 19:57:10",
          "data_alteracao": "2021-12-21 01:02:16",
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
          "data_alteracao": "2021-12-21 01:02:17",
          "fk_cidade": "1",
          "fk_usuario": "1"
        }
      ]
    }
  ]
}
```

## Efetuar Login

### Requisição

`POST /login`

#### Json

```json
{
  "cpf": "00000000000",
  "password": "123456"
}
```

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJOb3ZvIE5vbWUgVXN1XHUwMGUxcmlvIiwic3ViIjoiMDAwMDAwMDAwMDAiLCJpYXQiOjE2NDAwNDgzMjd9.GLxz78emM45h2IEUYoyItV4siyOLJZKCettLm3Xf78c"
  }
}
```

## Listar Países

### Requisição

`GET /nations`

### Resposta

#### Json

```json
{
  "result": true,
  "message": "Sucesso.",
  "data": [
    {
      "id": "1",
      "nome": "Brasil",
      "sigla": "BR"
    }
  ]
}
```

## Listar Estados por País

### Requisição

`GET /states`

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
  "data": [
    {
      "id": "1",
      "nome": "Acre",
      "sigla": "AC",
      "fk_pais": "1"
    },
    "...",
    {
      "id": "27",
      "nome": "Tocantins",
      "sigla": "TO",
      "fk_pais": "1"
    }
  ]
}
```

## Listar Cidades por Estados

### Requisição

`GET /cities`

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
  "data": [
    {
      "id": "79",
      "nome": "Acrelândia",
      "fk_estado": "1"
    },
    "...",
    {
      "id": "100",
      "nome": "Xapuri",
      "fk_estado": "1"
    }
  ]
}
```