<?php

namespace LewisLarsen\Aether\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aether:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the aether account pages.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return [
                '@tailwindcss/forms' => '^0.2.1',
                'alpinejs'           => '^2.7.3',
                'autoprefixer'       => '^10.1.0',
                'postcss'            => '^8.2.1',
                'postcss-import'     => '^12.0.1',
                'tailwindcss'        => '^2.0.2',
            ] + $packages;
        });

        // Config
        copy(__DIR__.'/../../stubs/config/aether.php', config_path('aether.php'));

        // Avatar Migration File
        copy(__DIR__.'/../../database/migrations/2021_02_14_014204_add_avatar_path_column_to_users_table.php', database_path('migrations/2021_02_14_014204_add_avatar_path_column_to_users_table.php'));

        // Controllers...
        (new Filesystem())->ensureDirectoryExists(app_path('Http/Controllers/Account'));
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/App/Http/Controllers/Account', app_path('Http/Controllers/Account'));

        // Views...
        (new Filesystem())->ensureDirectoryExists(resource_path('views/account'));
        (new Filesystem())->ensureDirectoryExists(resource_path('views/layouts'));
        (new Filesystem())->ensureDirectoryExists(resource_path('views/components'));

        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/resources/views/account', resource_path('views/account'));
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/resources/views/layouts', resource_path('views/layouts'));
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/resources/views/components', resource_path('views/components'));

        // Components...
        (new Filesystem())->ensureDirectoryExists(app_path('View/Components'));
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/App/View/Components', app_path('View/Components'));

        // Tests...
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/tests/Feature', base_path('tests/Feature'));

        // Actions
        (new Filesystem())->copyDirectory(__DIR__.'/../../stubs/App/Actions', app_path('Actions'));

        // Routes...
        copy(__DIR__.'/../../stubs/routes/web.php', base_path('routes/web.php'));
        copy(__DIR__.'/../../stubs/routes/account.php', base_path('routes/account.php'));

        // "Dashboard" Route...
        //$this->replaceInFile('/home', '/dashboard', resource_path('views/welcome.blade.php'));
        //$this->replaceInFile('Home', 'Dashboard', resource_path('views/welcome.blade.php'));
        //$this->replaceInFile('/home', '/dashboard', app_path('Providers/RouteServiceProvider.php'));

        $this->info('Aether account pages installed successfully.');
    }

    /**
     * Update the "package.json" file.
     *
     * @param callable $callback
     * @param bool     $dev
     *
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem(), function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Replace a given string within a given file.
     *
     * @param string $search
     * @param string $replace
     * @param string $path
     *
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
