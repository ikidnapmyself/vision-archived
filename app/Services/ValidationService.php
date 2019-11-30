<?php
namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ValidationService
{
    /**
     * Validation rules.
     *
     * @var array $rules
     */
    protected $rules = [];

    /**
     * Request instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function request()
    {
        return app('request');
    }

    /**
     * Add rules.
     *
     * @param array $rules
     * @return $this
     */
    public function addRule(array $rules): self
    {
        $this->rules = array_merge($this->rules, $rules);

        return $this;
    }

    /**
     * @param array $data
     * @param array $rules
     * @return array
     */
    public function validate(?array $data = null, ?array $rules = null): array
    {
        return Validator::make($data ?? $this->request()->all(), $rules ?? $this->rules)->validate();
    }
}
