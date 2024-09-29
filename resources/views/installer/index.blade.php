<x-layout class="py-10">
    <main class="h-screen py-10">
        <div class="max-w-lg w-full mx-auto bg-white shadow rounded overflow-hidden">
            <div class="py-10 flex items-center justify-center bg-primary shadow-md">
                <x-logo disabled/>
            </div>
            <div class="py-8 px-4 space-y-6">
                <x-forms.form class="p-3 border border-b rounded" method="POST" action="{{route('install')}}">
                    <div>
                    <h4 class="text-sm font-semibold pb-2">Application Setup</h4>
                    <x-forms.input
                        label="Application URL"
                        name="app_url"
                        placeholder="https://ticktastic.app"
                        value="{{$default_config['app_url']}}"
                    />
                    </div>

                    <div>
                    <h4 class="text-sm font-semibold pb-2">Database Setup</h4>
                        <div class="space-y-6">
                            <x-forms.select label="Database Type" name="database_type">
                                <option value="MySQL" {{ $default_config['database_type'] == 'MySQL' ? 'selected' : '' }}>MySQL</option>
                                <option value="Postgres" {{ $default_config['database_type'] == 'Postgres' ? 'selected' : '' }}>Postgres</option>
                            </x-forms.select>

                            <x-forms.input label="Database Host" name="database_host" value="{{$default_config['database_host']}}"/>
                            <x-forms.input label="Database Name" name="database_name" value="{{$default_config['database_name']}}"/>
                            <x-forms.input label="Database Username" name="database_username" value="{{$default_config['database_username']}}"/>
                            <x-forms.input label="Database Password" name="database_password" value="{{$default_config['database_password']}}"/>
                            <a class="inline-block bg-blue-600 py-2 px-3 text-white hover:bg-blue-600 rounded-sm"
                               href="{{route('install', ['test'=> 'db'])}}"
                            >Test Connection
                            </a>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-sm font-semibold">E-mail Configuration</h4>
                        <x-forms.input label="Mail From Address" name="mail_from_address" value="{{$default_config['mail_from_address']}}"/>
                        <x-forms.input label="Mail From Name" name="mail_from_name" value="{{$default_config['mail_from_name']}}"/>
                        <x-forms.input label="Mail Driver" name="mail_driver" value="{{$default_config['mail_driver']}}"/>
                        <x-forms.input label="Mail Port" name="mail_port" value="{{$default_config['mail_port']}}"/>
                        <x-forms.input label="Mail Encryption" name="mail_encryption" placeholder="tls/ssl" value="{{$default_config['mail_encryption']}}"/>
                        <x-forms.input label="Mail Host" name="mail_host" value="{{$default_config['mail_host']}}"/>
                        <x-forms.input label="Mail Username" name="mail_username" value="{{$default_config['mail_username']}}"/>
                        <x-forms.input label="Mail Password" name="mail_password" value="{{$default_config['mail_password']}}"/>
                    </div>
                    <x-forms.button>Install TickTastic</x-forms.button>
                </x-forms.form>
            </div>
        </div>
    </main>
</x-layout>
