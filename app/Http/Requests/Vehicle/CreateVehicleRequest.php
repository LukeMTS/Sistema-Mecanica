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
      'user_id' => 'required',
      'model' => 'required|max:100',
      'brand' => 'required|max:100',
      'license_plate' => 'required|max:7',
      'version' => 'required|max:6',
    ];
  }
}
