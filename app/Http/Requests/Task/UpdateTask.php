<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = Task::find($this->input("id"));
        return $this->user()->can("update", $task, Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=> "required|alpha|max:100|min:3",
            "description"=> "alpha|min:5|max:255|nullable",
        ];
    }
}
