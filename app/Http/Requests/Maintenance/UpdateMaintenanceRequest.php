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
      'description' => 'required|max:65000',
      'deadline' => 'required|date_format:Y-m-d',
    ];
  }
}
