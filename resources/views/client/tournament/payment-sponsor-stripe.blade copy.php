@extends('client.master.template')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/upload-avatar.css') }}">
    <style>
        .form-group select {
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 4px;
            box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 6%);
            height: 57px;
            padding: 0 25px;
            background: rgba(35, 42, 92, .5);
            color: #fff;
        }

        .form-group option {
            background: rgba(35, 42, 92);
            font-size: 15px;
        }

        input {
            color: white;
        }
    </style>
    <style>
        .form-group select {
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 4px;
            box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 6%);
            height: 57px;
            padding: 0;
            background: rgba(35, 42, 92, .5);
            color: #fff;
        }

        .form-group option {
            padding: 5px 0;
            background: rgba(35, 42, 92);
            font-size: 15px;
        }
    </style>
@endsection

@section('body_content')
    <div class="container my-4">
        <div class="row">
            <h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">
                {{ __('sponsor.head') }}
                <br>
                - {{ $tournament->name }} -
            </h3>
            <form role="form" action="{{ route('sponsor.processing.stripe') }}" method="post" class="require-validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"
                enctype='multipart/form-data'>
                @csrf

                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="sponsor_id" value="{{ $sponsor_id }}">
                <input type="hidden" name="league_id" value="{{ $league_id }}">

                <div class="col-md-6 col-md-offset-3 m-auto mb-5 mt-3 p-5 border border-white" style="border-radius: 30px">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading">
                            <div class="row">
                                <h3>{{ __('sponsor.payment-card') }}</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <br>

                            <div class='form-row row my-2'>
                                <div class='col-xs-12 col-md-12 form-group required'>
                                    <label class='control-label'>{{ __('sponsor.payment.card-number') }}</label>
                                    <input autocomplete='off' maxlength="16" class='form-control card-number' required
                                        size='20' type='text' placeholder="Ex: 4111 1111 1111 1111">
                                </div>
                            </div>
                            <div class='form-row row my-2'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>{{ __('sponsor.payment.CVC') }}</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' required
                                        size='4' maxlength="4" type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>{{ __('sponsor.payment.expiration-month') }}</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                        maxlength="2" type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>{{ __('sponsor.payment.expiration-year') }}</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' required
                                        maxlength="4" type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-md-12 error form-group d-none'>
                                    <div class='text-danger text-italic'>Please correct the errors and try
                                        again.</div>
                                </div>
                            </div>

                            <div class="form-row row mt-4">
                                <div class="col-xs-12 ">
                                    <button class="btn btn-primary btn-lg btn-block"
                                        type="submit">{{ __('sponsor.payment.btn-submit') }}</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
@endsection

@section('js')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('d-none');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endsection
