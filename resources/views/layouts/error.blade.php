@if (session('error'))
    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <span class="font-medium">{{session('error')}}</span>
    </div>
@endif