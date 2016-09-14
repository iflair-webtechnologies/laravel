<button class="feedback" title="Geef feedback of stel een vraag">Feedback | Stel een vraag</button>
<div id="feedback-formulier" style="display:none;">
    <div class="feedback-header">
        <i class="fa fa-close fa-lg close-feedback"></i>
    </div>
    <div class="feedback-content">
        <div class="feedback-success">
            <p>Uw bericht is verstuurt en zal zo snel mogelijk worden beantwoord.</p>
        </div>
        <form action="{{ route('global.feedback') }}" method="post" class="feedback-form">

            @if(Auth::guest())
                <input type="text" name="name" placeholder="Uw naam*" required><br>
                <input type="email" name="email" placeholder="Uw emailadres*" required><br>
            @endif

            <textarea id="comment" name="comment" rows="3" placeholder="Uw vraag/opmerking*" required></textarea><br>

            @if(Auth::guest())
                {!! Recaptcha::render() !!}
            @endif
            <br>

            <div class="opslaan-pijltje">
                <input type="submit" class="opslaan submit-feedback" value="Verzend">
            </div>
        </form>
    </div>
</div>