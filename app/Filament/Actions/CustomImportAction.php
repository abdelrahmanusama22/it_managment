<?php

namespace App\Filament\Actions;

use Filament\Actions\ImportAction as BaseImportAction;

class CustomImportAction extends BaseImportAction
{
    /**
     * Override the default file validation rules to prevent strict MIME type 
     * guessing failures on shared hosting environments like Bluehost.
     */
    public function getFileValidationRules(): array
    {
        $rules = parent::getFileValidationRules();

        // 1. Remove Filament's strict 'extensions:' rule. 
        // On Bluehost, the 'fileinfo' extension often misidentifies .xlsx as 
        // 'application/zip' or 'application/octet-stream'. Laravel then guesses 
        // the extension as '.zip', causing the 'extensions:csv,txt,xlsx,xls' rule to fail.
        $rules = array_filter($rules, function ($rule) {
            return ! is_string($rule) || ! str_starts_with($rule, 'extensions:');
        });

        // 2. Add a relaxed rule that allows 'zip' (which .xlsx actually is under the hood)
        // and 'bin' to bypass the server's strict MIME guessing.
        $rules[] = 'mimes:csv,txt,xls,xlsx,zip,bin';

        return array_values($rules);
    }
}
