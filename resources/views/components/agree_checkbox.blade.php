<div class="col s12 remember">
    <p>
        <label>
            <input type="checkbox" name="terms"
                   id="terms" required/>
            <span>@lang('terms.agree')
                <a href="{{route("privacy")}}">@lang('terms.privacy')</a>
                @lang('terms.connection')
                <a href="{{route("terms")}}">@lang('terms.terms')</a>
            </span>
        </label>
    </p>
</div>