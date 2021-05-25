<?php

declare(strict_types=1);

namespace App\Request\Demo\IndexController;

use Whyperf\Validator\ValidatedRequest;

/**
 * Class FooRequest
 * @package App\Request
 * @author WANG RUNXIN
 */
class IndexRequest extends ValidatedRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer'],
            'date' => ['required']
        ];
    }
}
