<?php

namespace DavidSchneiderInfo\LaravelUi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Laravel\Ui\Presets\Bootstrap;
use Laravel\Ui\Presets\React;
use Laravel\Ui\Presets\Vue;

class InstallUICommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'ui:install
                    { type : The preset type (bootstrap, vue, react) }
                    { --no-auth : Do not install authentication UI scaffolding }
                    { --option=* : Pass an option to the preset command }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Swap the front-end scaffolding for the application';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function handle()
    {
        if (static::hasMacro($this->argument('type'))) {
            return call_user_func(static::$macros[$this->argument('type')], $this);
        }

        if (! in_array($this->argument('type'), ['bootstrap', 'vue', 'react'])) {
            throw new InvalidArgumentException('Invalid preset.');
        }

        if ($this->option('no-auth')) {
            $this->call('ui:install:auth');
        }

        $this->{$this->argument('type')}();
    }

    /**
     * Install the "bootstrap" preset.
     *
     * @return void
     */
    protected function bootstrap()
    {
        Bootstrap::install();

        $this->components->info('Bootstrap scaffolding installed successfully.');
        $this->components->warn('Please run [npm install && npm run dev] to compile your fresh scaffolding.');
    }

    /**
     * Install the "vue" preset.
     *
     * @return void
     */
    protected function vue()
    {
        Bootstrap::install();
        Vue::install();

        $this->components->info('Vue scaffolding installed successfully.');
        $this->components->warn('Please run [npm install && npm run dev] to compile your fresh scaffolding.');
    }

    /**
     * Install the "react" preset.
     *
     * @return void
     */
    protected function react()
    {
        Bootstrap::install();
        React::install();

        $this->components->info('React scaffolding installed successfully.');
        $this->components->warn('Please run [npm install && npm run dev] to compile your fresh scaffolding.');
    }}