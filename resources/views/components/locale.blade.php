@props(['lang', 'flag'])

<form action="{{ route('setLocale', $lang) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn p-0 border-0 bg-transparent mx-1" title="{{ $lang }}">
        <img src="https://flagcdn.com/48x36/{{ $flag }}.png" width="28" alt="{{ $lang }}" style="border-radius: 3px;">
    </button>
</form>