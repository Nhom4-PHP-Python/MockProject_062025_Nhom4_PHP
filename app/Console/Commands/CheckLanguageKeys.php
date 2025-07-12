<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Services\LanguageService;

class CheckLanguageKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:check {--fix : Fix missing keys automatically}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for missing translation keys across all language files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $supportedLocales = array_keys(LanguageService::getSupportedLocales());
        $baseLocale = 'en'; // Base language to compare against

        $this->info('Checking language keys...');

        // Get all keys from base language
        $baseKeys = $this->getLanguageKeys($baseLocale);

        if (empty($baseKeys)) {
            $this->error("Could not load base language file: {$baseLocale}");
            return 1;
        }

        $this->info("Base language ({$baseLocale}) has " . count($baseKeys) . " keys");

        $missingKeys = [];

        // Check each supported locale
        foreach ($supportedLocales as $locale) {
            if ($locale === $baseLocale) continue;

            $localeKeys = $this->getLanguageKeys($locale);
            $missing = array_diff($baseKeys, $localeKeys);

            if (!empty($missing)) {
                $missingKeys[$locale] = $missing;
                $this->warn("Language '{$locale}' is missing " . count($missing) . " keys:");
                foreach ($missing as $key) {
                    $this->line("  - {$key}");
                }
            } else {
                $this->info("Language '{$locale}' is complete ✓");
            }
        }

        if ($this->option('fix') && !empty($missingKeys)) {
            $this->info("\nFixing missing keys...");
            $this->fixMissingKeys($missingKeys, $baseLocale);
        }

        return 0;
    }

    /**
     * Get all keys from a language file
     */
    private function getLanguageKeys($locale)
    {
        $langPath = base_path("lang/{$locale}/messages.php");

        if (!File::exists($langPath)) {
            return [];
        }

        $messages = include $langPath;

        if (!is_array($messages)) {
            return [];
        }

        return array_keys($messages);
    }

    /**
     * Fix missing keys by adding them with placeholder values
     */
    private function fixMissingKeys($missingKeys, $baseLocale)
    {
        $baseMessages = include base_path("lang/{$baseLocale}/messages.php");

        foreach ($missingKeys as $locale => $keys) {
            $langPath = base_path("lang/{$locale}/messages.php");

            if (!File::exists($langPath)) {
                $this->error("Language file not found: {$langPath}");
                continue;
            }

            $messages = include $langPath;

            foreach ($keys as $key) {
                $messages[$key] = $baseMessages[$key] ?? "[TRANSLATE] {$key}";
            }

            // Write back to file
            $content = "<?php\n\nreturn " . var_export($messages, true) . ";\n";
            File::put($langPath, $content);

            $this->info("Fixed " . count($keys) . " keys for locale '{$locale}'");
        }
    }
}
