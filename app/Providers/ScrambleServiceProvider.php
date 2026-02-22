<?php

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\InfoObject;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Dedoc\Scramble\Support\Generator\Server;
use Dedoc\Scramble\Support\Generator\Tag;
use Illuminate\Support\ServiceProvider;

class ScrambleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Scramble::afterOpenApiGenerated(function (OpenApi $openApi) {
            $openApi->setInfo(
                (new InfoObject('Translockit API', config('scramble.info.version', '1.0.0')))
                    ->setDescription('Complete REST API documentation for Translockit - Authentication, Content Management, Settings, and Translation services.')
            );

            $openApi->addServer(Server::make(url('/api')));

            // Add Bearer token security scheme
            $openApi->secure(
                SecurityScheme::http('bearer', 'Bearer Token Authentication')
            );

            // Define tag descriptions
            $openApi->tags = [
                new Tag('Authentication', 'User authentication endpoints for login, logout, and user management.'),
                new Tag('Dashboard', 'Dashboard statistics and metrics endpoints.'),
                new Tag('Abouts', 'About entries management endpoints.'),
                new Tag('Articles', 'Article management endpoints for blog/content management.'),
                new Tag('Authors', 'Author management endpoints.'),
                new Tag('Categories', 'Article category management endpoints.'),
                new Tag('Brands', 'Brand management endpoints.'),
                new Tag('Testimonials', 'Testimonial management endpoints for customer reviews.'),
                new Tag('Software', 'Software product management endpoints.'),
                new Tag('Projects', 'Project management endpoints.'),
                new Tag('Mobile Apps', 'Mobile application management endpoints.'),
                new Tag('Mobile Lists', 'Mobile list management endpoints.'),
                new Tag('FAQs', 'Frequently Asked Questions management endpoints.'),
                new Tag('Settings', 'Application and company settings management endpoints.'),
                new Tag('Translation', 'AI-powered translation service endpoints.'),
            ];
        });

        // Only document API routes
        Scramble::routes(function ($route) {
            return $route->getDomain() === null
                && str_starts_with($route->uri(), 'api/');
        });
    }
}
