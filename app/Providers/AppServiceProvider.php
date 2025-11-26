<?php

namespace App\Providers;

use Event;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Discord\Provider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('discord', Provider::class);
        });

        //        Gate::before(function ($user, $ability) {
        //
        //            // If an array passed: @access(['admin.*', 'reports.view'])
        //            $abilities = is_array($ability) ? $ability : [$ability];
        //
        //            $userPermissions = $user->getPermissionNames()->toArray();
        //
        //            foreach ($abilities as $check) {
        //
        //                // Spatie exact match
        //                if (!str_contains($check, '*')) {
        //                    Logger::info($check);
        //                    if ($user->hasPermissionTo($check)) {
        //                        return true;
        //                    }
        //                }
        //
        //                // Wildcard match
        //                foreach ($userPermissions as $perm) {
        //                    if (Str::is($check, $perm)) {
        //                        return true;
        //                    }
        //                }
        //            }
        //
        //            return null; // fallback to default Spatie behavior
        //        });

        Blade::directive('access', function ($abilities) {
            return "<?php if(auth()->check() && auth()->user()->canAccess($abilities)): ?>";
        });

        Blade::directive('endaccess', function () {
            return '<?php endif; ?>';
        });

    }
}
