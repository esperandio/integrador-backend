<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Ports;

use App\Presentation\Ports\{RequestInput, RequestOutput};
use App\Presentation\Controllers\Exceptions\MissingParamException;

abstract class ControllerTemplate
{
    /**
     * @var array<string> $requiredParams
     */
    protected array $requiredParams = [];

    public function handle(RequestInput $requestInput): RequestOutput
    {
        $missingParams = $this->getMissingParameters($requestInput);

        if (!empty($missingParams)) {
            throw new MissingParamException($missingParams);
        }

        return $this->performSpecificOperation($requestInput);
    }

    /**
     * @return array<string>
     */
    private function getMissingParameters(RequestInput $requestInput): array
    {
        $missingParams = array_filter($this->requiredParams, function ($param) use ($requestInput) {
            return !array_key_exists($param, $requestInput->body);
        });

        if (empty($missingParams)) {
            return [];
        }

        return array_values($missingParams);
    }

    abstract protected function performSpecificOperation(RequestInput $requestInput): RequestOutput;
}
