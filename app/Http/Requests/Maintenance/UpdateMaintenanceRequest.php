<?php

namespace App\Http\Requests\Maintenance;

use App\Http\Controllers\MaintenanceController;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaintenanceRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'id_vehicle' => 'required',
      'description' => 'required|max:65000',
      'deadline' => 'required|date_format:Y-m-d',
    ];
  }

  public function messages()
  {
    return [
      'description.required' => 'É necessário uma descrição do problema',
      'deadline.required' => 'É necessário uma data para manutenção',
      'id_vehicle.required' => 'É necessário selecionar um carro',
    ];
  }
}
