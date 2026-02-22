<?php

namespace App\Extensions\Scramble;

use Dedoc\Scramble\Extensions\OperationExtension;
use Dedoc\Scramble\Support\Generator\Operation;
use Dedoc\Scramble\Support\Generator\Parameter;
use Dedoc\Scramble\Support\Generator\Schema;
use Dedoc\Scramble\Support\Generator\Types\ObjectType;
use Dedoc\Scramble\Support\Generator\Types\StringType;
use Dedoc\Scramble\Support\RouteInfo;

class ApiDocsExtension extends OperationExtension
{
    public function handle(Operation $operation, RouteInfo $routeInfo): void
    {
        // Add security scheme for Sanctum
        if (str_contains($routeInfo->route->uri, 'api/')) {
            $operation->addSecurity('sanctum');
        }

        // Add common response schemas
        $operation->addResponse('401', $this->unauthorizedResponse());
        $operation->addResponse('404', $this->notFoundResponse());
        $operation->addResponse('422', $this->validationErrorResponse());
    }

    private function unauthorizedResponse(): array
    {
        return [
            'description' => 'Unauthenticated',
            'content' => [
                'application/json' => [
                    'schema' => Schema::fromType(
                        (new ObjectType())
                            ->addProperty('success', (new StringType())->example('false'))
                            ->addProperty('message', (new StringType())->example('Unauthenticated.'))
                    ),
                ],
            ],
        ];
    }

    private function notFoundResponse(): array
    {
        return [
            'description' => 'Resource not found',
            'content' => [
                'application/json' => [
                    'schema' => Schema::fromType(
                        (new ObjectType())
                            ->addProperty('success', (new StringType())->example('false'))
                            ->addProperty('message', (new StringType())->example('Not found'))
                    ),
                ],
            ],
        ];
    }

    private function validationErrorResponse(): array
    {
        return [
            'description' => 'Validation error',
            'content' => [
                'application/json' => [
                    'schema' => Schema::fromType(
                        (new ObjectType())
                            ->addProperty('success', (new StringType())->example('false'))
                            ->addProperty('message', (new StringType())->example('Validation failed'))
                            ->addProperty('errors', (new ObjectType())->example(['email' => ['The email field is required.']]))
                    ),
                ],
            ],
        ];
    }
}
