<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeOrionController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:orion-controller {name} {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Orion API Controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Orion Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        // Check if the user has a customized Orion controller stub in the stubs directory
        $customStub = base_path('stubs/make.orion.controller.stub');

        return file_exists($customStub)
            ? $customStub
            : __DIR__ . '/stubs/orion-controller.stub'; // Provide a default fallback
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        // Default namespace for API controllers
        return $rootNamespace . '\\Http\\Controllers\\Api';
    }

    /**
     * Replace the model class in the generated stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        $modelName = $this->argument('model');

        return str_replace(['{{ model }}', '{{ class }}'], [$modelName, $this->getNameInput()], $stub);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the controller'],
            ['model', InputArgument::REQUIRED, 'The name of the associated model'],
        ];
    }
}
