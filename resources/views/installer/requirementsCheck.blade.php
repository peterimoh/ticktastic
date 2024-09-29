<x-layout>
    <main class="h-screen py-10">
        <div class="max-w-xl w-full mx-auto bg-white shadow rounded overflow-hidden">
            <div class="py-10 flex items-center justify-center bg-primary shadow-md">
                <x-logo disabled/>
            </div>

            @if(count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif

            <div class="py-4 px-3">
                <h4 class="text-sm font-semibold pb-2">Requirements Check</h4>
                <div class="space-y-4">
                    <div class="mb-6">
                        <span class="text-[13px]">PHP Version Check</span>
                        @if(version_compare(phpversion(), '8.2.0', '<'))
                            <div class="bg-red-200 p-1">
                            <span class="text-red-600 text-[12px]">
                                Warning: The application requires PHP >= <b>8.2.0.</b> Your version is <b>{{phpversion()}}</b>.
                            </span>
                            </div>
                            @php $has_errors = true; @endphp
                        @else
                            <div class="bg-green-100 p-1">
                            <span class="text-green-600 text-[12px]">
                                The application requires PHP >= <b>8.2.0.</b> Your version is <b>{{phpversion()}}</b>.
                            </span>
                            </div>
                        @endif
                    </div>

                    <div>
                        <div class="space-y-1">
                            <span class="text-[13px]">Files and Folders Permission</span>

                            @foreach($paths as $path)
                                @if(!is_writable($path))
                                    <div class="bg-red-200 text-red-600 p-2">
                                        <strong>{{$path}}</strong> is not writable
                                    </div>
                                    @php $has_errors = true; @endphp
                                @else
                                    <div class="bg-green-200 text-green-600 p-2">
                                        <strong>{{$path}}</strong> is writable
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="space-y-1">
                            <span class="text-[13px]">Required Extensions</span>
                            @foreach($requirements as $requirement)
                                @if(!extension_loaded($requirement))
                                    <div class="bg-red-200 text-red-600 p-2">
                                        <strong>{{$requirement}}</strong> is not loaded
                                    </div>
                                    @php $has_errors = true; @endphp
                                @else
                                    <div class="bg-green-200 text-green-600 p-2">
                                        <strong>{{$requirement}}</strong> is loaded
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="space-y-1">
                            <span class="text-[13px]">Optional Extensions</span>
                            @foreach($optional_requirements as $optional_requirement)
                                @if(!extension_loaded($optional_requirement))
                                    <div class="bg-orange-200 text-orange-600 p-2">
                                        <strong>{{$optional_requirement}}</strong> is not loaded
                                    </div>
                                @else
                                    <div class="bg-green-200 text-green-600 p-2">
                                        <strong>{{$optional_requirement}}</strong> is loaded
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if(empty($has_errors))
                <div class="p-4 text-right">
                    <a href="{{ route('install') }}" class="bg-blue-500 text-white p-2 rounded">
                        Proceed to Installation
                    </a>
                </div>
            @endif

        </div>
    </main>
</x-layout>
