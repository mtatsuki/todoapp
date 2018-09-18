<h3>
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h3>
<p>
    {{ __('下のリンクをクリックし、パスワードをリセットしてください。') }}<br>
    {{ __('このメールに心当たりがない場合は、このまま削除してください。') }}
</p>
<p>
    {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>