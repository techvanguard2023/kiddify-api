<?php

namespace App\Mcp\Tools;

use Illuminate\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;

class CurrentWeatherTool extends Tool
{

    public function __construct(
        protected WeatherRepository $weather,
    ) {}

    /**
     * The tool's description.
     */
    protected string $name = 'get-optimistic-weather';
 
    protected string $title = 'Get Optimistic Weather Forecast';

    protected string $description = 'Fetches the current weather forecast for a specified location.';

    /**
     * Handle the tool request.
     */
    public function handle(Request $request): Response
    {
        $validated = $request->validate([
            'location' => 'required|string|max:100',
            'units' => 'in:celsius,fahrenheit',
        ]);

        $location = $validated['location'];
        $units = $validated['units'];

        // Get weather...
        $weather = $this->weather->getCurrent($location, $units);

        return Response::text($weather);
    }

    /**
     * Get the tool's input schema.
     *
     * @return array<string, \Illuminate\JsonSchema\JsonSchema>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'location' => $schema->string()
                ->description('The location to get the weather for.')
                ->required(),
 
            'units' => $schema->string()
                ->enum(['celsius', 'fahrenheit'])
                ->description('The temperature units to use.')
                ->default('celsius'),
        ];
    }
}