<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Request;

class ValidationService
{
    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * Add rule.
     *
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addRule(string $key, string $value): self
    {
        $this->rules = array_merge($this->rules, [
            $key => $value,
        ]);

        return $this;
    }

    /**
     * Add rules.
     *
     * @param array $rules
     * @return $this
     */
    public function addRules(array $rules): self
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    /**
     * @param array|null $data
     * @param array|null $rules
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate(?array $data = null, ?array $rules = null): array
    {
        $fields = Request::all();

        return Validator::make($data ?? $fields, $rules ?? $this->rules)->validate();
    }
}
