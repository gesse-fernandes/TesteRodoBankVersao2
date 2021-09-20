<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"> <img src="https://vuejs.org/images/logo.svg" height="50" width="50"></p>


# Teste de seleção para empresa RodoBank neste teste foi utilizado tecnologias backend laravel em php e tecnologia front-end foi vueJs em Javascript.

# Requisitos

1. Utilizar PHP versão 7 ou superior.
2. Desenvolver a API usando Laravel ou Lumen.
3. Utilizar OO.
4. Subir o projeto no GITHUB.
5. Criar um Readme para exemplificar o projeto

# Solicitado

#1. Desenvolver um CRUD para fretes. (Endpoints: Criar, Editar, Deletar, Listar,
Pesquisar)

a. Campos obrigatórios:

i. Placa;

ii. Dono do veículo;

iii. Valor do frete;

iv. Data de início e data de fim do frete;

v. Status ( Iniciado, em trânsito, concluído );

## criar EndPoint(api/freight) verbo POST

<img src="./front-end/src/assets/criar.jpg" >

## editar EndPoint(api/freight/{freight}) verbo POST

<img src="./front-end/src/assets/editar.jpg">

## deletar EndPoint(api/freight/{freight}) verbo DELETE

<img src="./front-end/src/assets/deletar.jpg" >

## listar EndPoint(api/freight) verbo GET

<img src="./front-end/src/assets/listagem.JPG" >

## pesquisar EndPoint(api/freight) verbo POST

<img src="./front-end/src/assets/pesquisar.jpg">

## Validação e as mensagens do back-end para o front-end

<img src="./front-end/src/assets/mensagensValidacao.jpg">
## Para baixar ou Avaliar o projeto



Primeiro passo, clonar o projeto:
``` bash
# Clonar
https://github.com/gesse-fernandes/TesteRodoBankVersao2.git
```
## Configuração - Back-end
``` bash
# Configurar variáveis de ambiente
cp .env.example .env
php artisan key:generate
# Criar migrations (tabela e Seeder)
php artisan migrate --seed
# apos criar tudo entrar na pasta backend
cd backend
#iniciar o sevidor
php artisan serve
```
# Configuração do Front-end
``` bash
# Atualizar dependências
npm install ou yarn 
# apos atualizar as dependências tudo entrar na pasta front-end
cd front-end
# Rodar em ambiente local localhost:8080
npm run dev ou yarn run serve

# Rodar em ambiente de produção
npm run build ou yarn run build
```

