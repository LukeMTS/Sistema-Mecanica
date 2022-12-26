<?php

namespace App\Http\Requests\Vehicle;

use App\Http\Controllers\VehicleController;
use App\Models\Portal\Vehicle;
use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
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
      'model' => 'required|max:100',
      'brand' => 'required|max:100',
      'license_plate' => 'required|max:7',
      'version' => 'required|numeric',
    ];
  }

  public function messages()
  {
    return [
      'version.numeric' => 'A versão deve ser um valor numérico',
      'model.required' => 'Necessita de um modelo',
      'brand.required' => 'Necessita de uma marca',
      'license_plate.required' => 'Necessita de uma placa',
      'version.required' => 'Necessita de uma versão',
      'model.max' => 'Permitido no máximo 100 caracteres',
      'brand.max' => 'Permitido no máximo 100 caracteres',
      'license_plate.max' => 'Permitido no máximo 7 caracteres',
    ];
  }
}
