<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreightRequest;
use App\Models\Freight;
use Database\Seeders\FreightSeed;
use Illuminate\Http\Request;
//TODO.Este é meu controller
//TODO para fazer api sempre é bom criar
//TODO uma pasta Api onde vão ter todos meu controller da Api
//TODO também o utilizo o recurso do resource onde
//TODO já vão ter todos os metodos por padrão
//TODO retirei o create e edit já que o front-end é vueJs
class FreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     TODO aqui defino uma variavel freight(frete)
     TODO que vai servir como ponto de referência
     TODO a minha classe freight do seu modo podendo assim
     TODO ter acesso aos metodos e funções
    */
    private $freight;
    /*
     TODO defino a minha total de paginas que vai ser
     TODO minha paginação
    */
    private $totalPage = 4;
    // TODO aqui onde crio o meu construtor

    public function __construct(Freight $freight)
    {
        $this->freight = $freight;
    }
    /*
    TODO minha função index que vai me retornar todos
    TODO os dados inclusive com sua paginação definida
    TODO e também o endPoint de pesquisa que tem o metodo chave para o front-end é o board(placa do veiculo) podendo assim retornar seus dados ja que placa do veiculo não pode ser igual
    */
    public function index(Request $request)
    {
        /*
        TODO aqui eu faço a minha ligação
        TODO chamando a minha função getResults

        */
        $freight = $this->freight->getResults($request->all(),$this->totalPage);
        // TODO e aqui eu retorno em json para ser requisitado no front end para recuperar esses dados
        return response()->json($freight);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*
        TODO aqui é minha função store
        TODO onde vai realizar o cadastro
        TODO do Frete
    */
    public function store(FreightRequest $request)
    {
        /*
        TODO aqui mando um request pra pegar todos os dados
        TODO e também o tipo dele é um Request do proprio
        TODO  dados de acordo com o model assim podendo já retornar a validação e as mensagens de validação para que eu possa também recuperar no front-end
        */
        $data = $request->all();
        /*
        TODO aqui eu verifico se meu metodo create e os
        TODO dados passados bastando ja que é uma negação
        TODO seguindo raciocinio lógico e de logica proposicional ¬P -> se ele for verdadeiro vai
        TODO ser falso então bastava apenas um if
        TODO caso os dados não seja atribuido a variavel freight assim mandando um error 500
        TODO caso ele nem chegue entrar no if eu apenas retorno em json.
        */
        if(!$freight = $this->freight->create($data))
            return response()->json(['error'=> 'error_insert'],500);
        return response()->json($freight,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
     TODO Aqui minha função show para retornar um unico
     TODO dado do frete
    */
    public function show($id)
    {
        /*
         TODO Aqui mesma estrutura anterior
         TODO ele retorna em json depois de ter feito
         TODO a consulta a partir do id mas se ouver
         TODO algum problema eu mando um 404 que ele não
         TODO encontrou o que foi solicitado
        */
        if(! $freight= $this->freight->find($id))
            return response()->json(['error'=>'freight_not_found'],404);
        return response()->json($freight);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
     TODO Aqui minha função update que recebe
     TODO dois parametros um request http e outro
     TODO id para poder procurar aqueele frete para poder
     TODO fazer a edição no front
    */
    public function update(Request $request, $id)
    {
        /*
         TODO aqui eu valido de forma unica direta
         TODO poís sendo board(placa do veiculo) unico
         TODO impossivel usar o request do mesmo então
         TODO pelo http request valido aqui tanto
         TODO o que é como obrigatório tanto suas mensagens
        */
         //TODO validação
          $data = $request->validate([
            'board' => 'required',
            'vehicle_owner' => 'required',
            'price_freight' => 'required',
            'date_start' => 'required|date_format:Y-m-d',
            'date_end' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Iniciado,em trânsito,concluído',
          ],
          //TODO mensagens de validação mando pro front-end
          [
            'board.required' => 'Placa do veiculo é Obrigatória',
            'vehicle_owner.required' => 'Dono do Veiculo é Obrigatório',
            'price_freight.required' => 'Valor do frete Obrigatóio',
            'date_start.required' => 'Data inicio Obrigatória',
            'date_start.date_format' => 'formato de data invalido',
            'date_end.date_format' => 'formato de data invalido',
            'date_end.required' => 'Data fim Obrigatória',
            'status.required' => 'Status Obrigatório',
            'status.in' => 'Permitidos apenas(Iniciado,em trânsito,concluído)'
          ]);
          /*
          TODO aqui verifico se existe esse frete

          */
        if(!$freight = $this->freight->find($id))
            return response()->json(['error'=> 'freight_not_found'],404);
        /*
         TODO aqui verifico também se meus dados vão ser atualizados.
        */
        if(!$freight->update($data))
           return response()->json(['error'=> 'freight_not_update'],500);
           //TODO retorno em json.
        return response()->json($freight);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /*
      TODO minha função destroy que vai deletar
      TODO o frete que recebe como parametro
      TODO id para que possa procurar o frete
      TODO e podendo assim deletar esse frete
     */
    public function destroy($id)
    {
        //TODO verifico se existe o frete
        if(!$freight = $this->freight->find($id))
           return response()->json(['error'=>'freight_not_found'],404);
        //TODO verifco para que eu possa deletar
           if(!$freight->delete())
           return response()->json(['error'=>'freight_not_delete'],500);
        //TODO retorno porem vazio o codigo de resposta 204 já que deu certo
           return response()->json($freight,204);
    }
}
