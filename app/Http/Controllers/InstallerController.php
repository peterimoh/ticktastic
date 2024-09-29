<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class InstallerController extends Controller
{

    protected $installation_data = [];

    private $data;

    protected function constructInstallationData(): void
    {
        $this->addDefaultConfig();
        $this->addWriteablePaths();
        $this->addPHPExtensions();
        $this->addOptionalPHPExtensions();
    }

    public function checkpoint()
    {
        $this->constructInstallationData();
        return view('installer.requirementsCheck', $this->data);
    }

    public function index()
    {
        $this->constructInstallationData();

        if ($this->isInstalled()) {
            return view('installer.alreadyInstalled', $this->data);
        }

        return view('installer.index', $this->data);
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    protected function addDefaultConfig(): void
    {
        $database_default = config('database.default');
        $this->data['default_config'] = [
            'app_url' => Config::get('app.url'),
            'database_type' => $database_default,
            'database_host' => Config::get('database.connections.' . $database_default . '.host'),
            'database_name' => Config::get('database.connections.' . $database_default . '.database'),
            'database_username' => Config::get('database.connections.' . $database_default . '.username'),
            'database_password' => Config::get('database.connections.' . $database_default . '.password'),
            'mail_from_address' => Config::get('mail.from.address'),
            'mail_from_name' => Config::get('mail.from.name'),
            'mail_driver' => Config::get('mail.driver'),
            'mail_host' => Config::get('mail.host'),
            'mail_port' => Config::get('mail.port'),
            'mail_encryption' => Config::get('mail.mailers.smtp.encryption'),
            'mail_username' => Config::get('mail.mailers.smtp.username'),
            'mail_password' => Config::get('mail.mailers.smtp.password')
        ];
    }

    protected function validateDBConnectionDetails(Request $request): bool
    {
        try {
            $request->validate([
                'database_host' => 'required',
                'database_type' => 'required',
                'database_name' => 'required',
                'database_username' => 'required',
                'database_password' => 'required',
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Please enter all fields. ' . $e->getMessage());
        }
        return false;
    }

    protected function getDatabaseData(Request $request): array
    {
        return [
            'type' => $request->get('database_type'),
            'host' => $request->get('database_host'),
            'name' => $request->get('database_name'),
            'username' => $request->get('database_username'),
            'password' => $request->get('database_password'),
        ];
    }

    protected function getMailData(Request $request): array
    {
        return [
            'driver' => $request->get('mail_driver'),
            'host' => $request->get('mail_host'),
            'port' => $request->get('mail_port'),
            'encryption' => $request->get('mail_encryption'),
            'username' => $request->get('mail_username'),
            'password' => $request->get('mail_password'),
            'from_address' => $request->get('mail_from_address'),
            'from_name' => $request->get('mail_from_name'),
        ];
    }

    protected function addWriteablePaths(): void
    {
        $this->data['paths'] = [
            storage_path('app'),
            storage_path('framework'),
            storage_path('logs'),
            base_path('bootstrap/cache'),
            public_path(\config('ticktastic.event_images_path')),
            public_path(\config('ticktastic.organiser_images_path')),
            public_path(\config('ticktastic.event_pdf_tickets_path')),
            base_path('.env'),
            base_path()
        ];
    }

    protected function addPHPExtensions(): void
    {
        $this->data['requirements'] = [
            'openssl',
            'pdo',
            'mbstring',
            'fileinfo',
            'tokenizer',
            'gd',
            'zip'
        ];
    }

    protected function addOptionalPHPExtensions(): void
    {
        $this->data['optional_requirements'] = [
            'pdo_mysql',
            'pdo_pgsql',
        ];
    }

    public function isInstalled(): bool
    {
        return file_exists(base_path('install.lock'));
    }

    protected function createInstalledFile(): void
    {
        $version = trim(file_get_contents(base_path('VERSION')));
        $fp = fopen(base_path('install.lock'), 'w');
        fwrite($fp, $version);
        fclose($fp);
    }
}
