<div class="agreement_modal" @if(session()->get('app.agreement')) style="display: none" @endif>
    <div class="agreement_modal_body">
        <span class="close_modal_agreement">{{ __('×') }}</span>
        <p class="text-paragraph">Находясь на сайте, Вы соглашаетесь с
            <a class="btn-azure" href="{{ route('agreement') }}">политикой конфиденциальности</a>
            и использованием им cookie файлов
        </p>
    </div>
</div>
