<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    // TODO caso queira usar uma factorie pra gerar dados falsos
    use HasFactory;
    //TODO declaro o timestamps como falso para desabilitar colunas como create_at & update_at
    public $timestamps = false;
    //TODO aqui defino os campos que vão ser preenchidos
    protected $fillable =
    [
        'id',
        'board',
        'vehicle_owner',
        'price_freight',
        'date_start',
        'date_end',
        'status'

    ];
    //TODO aqui onde vai ser os campos obrigatorios na validação
    public static $rules =
    [
        'board' => 'required|unique:freights',
        'vehicle_owner' => 'required',
        'price_freight' => 'required',
        'date_start' => 'required|date_format:Y-m-d',
        'date_end' => 'required|date_format:Y-m-d',
        'status' => 'required|in:Iniciado,em trânsito,concluído',
    ];
    //TODO mensagens de validação
    public static $messages =
    [
        'board.required' => 'Placa do veiculo é Obrigatória',
        'board.unique'=>'Placa Já existe não pode ser usada',
        'vehicle_owner.required' => 'Dono do Veiculo é Obrigatório',
        'price_freight.required' => 'Valor do frete Obrigatóio',
        'date_start.required' => 'Data inicio Obrigatória',
        'date_start.date_format' => 'formato de data invalido',
        'date_end.date_format' => 'formato de data invalido',
        'date_end.required' => 'Data fim Obrigatória',
        'status.required' => 'Status Obrigatório',
        'status.in' => 'Permitidos apenas(Iniciado,em trânsito,concluído)'
    ];
    public function getResults(array $data, int $totalPage)
    {
        //TODO Se não existir filtro (board, vehicle_owner ou filter) retorna todos os resultados, paginados
        if (!isset($data['board']) && !isset($data['vehicle_owner']) && !isset($data['price_freight']) && !isset($data['date_start']) && !isset($data['date_end']))
        return $this->orderBy('id', 'DESC')->paginate($totalPage);

        //TODO Traz os resultados filtrados
        return $this->where(function ($query) use ($data) {
            if (isset($data['board'])) {
                $board = $data['board'];
                $query->where('board', 'LIKE', "%{$board}%");
            }

            if (isset($data['vehicle_owner'])) {
                $vehicle_owner = $data['vehicle_owner'];
                $query->where('vehicle_owner', 'LIKE', "%{$vehicle_owner}%");
            }

            if (isset($data['filter'])) {
                $filter = $data['filter'];

                $query->where('board', 'LIKE', "%{$filter}%")
                ->orWhere('vehicle_owner', 'LIKE', "%{$filter}%");
            }
        })
            ->orderBy('id', 'DESC')
            ->paginate($totalPage); //TODO  ->toSql();
    }
}
