<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * @property string|null $category_id
 * @property int $page
 * @property int $per_page
 */
final class ProviderIndexRequest extends FormRequest
{
    private const int DEFAULT_PAGE     = 1;
    private const int DEFAULT_PER_PAGE = 20;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'nullable|uuid:7',
            'page'        => 'integer|min:1',
            'per_page'    => 'integer|min:1|max:100',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'page'     => (int)$this->input('page', self::DEFAULT_PAGE),
            'per_page' => (int)$this->input('per_page', self::DEFAULT_PER_PAGE),
        ]);
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new UnprocessableEntityHttpException($validator->errors()->toPrettyJson());
    }
}
