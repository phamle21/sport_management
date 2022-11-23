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
            <form role="form" action="{{ route('sponsor.processing') }}" method="post" class="require-validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form" enctype='multipart/form-data'>
                @csrf
                <input type="hidden" name="league_id" value={{ $tournament->id }}>
                <div class="col-md-6 col-md-offset-3 m-auto mb-5 mt-3 p-5 border border-white rounded-4">
                    <div class="row">
                        <div class="col">
                            <h3>{{ __('sponsor.head-info') }}</h3>
                        </div>
                        <div class="col form-group">
                            <select name="select_status" id="" class="text-white" required
                                onchange="changeStatusSponsor(this.value)">
                                <option selected value="new">{{ __('sponsor.select-new') }}</option>
                                <option value="old">{{ __('sponsor.select-old') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center w-100 ">
                        <div class="col">
                            <div class="container">
                                <div class="avatar-upload d-flex flex-column align-items-center mt-5">
                                    <div class="avatar-edit select_sponsor-new">
                                        <input type='file' id="imageUpload" name="sponsor_logo" required
                                            class="select_sponsor-new" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" onclick="triggerInputFile()" style="background-image: url('');">
                                        </div>
                                    </div>
                                    <label id="label-image" class="col d-flex justify-content-start mt-2">
                                        <p class="text-warning"></p>
                                    </label>
                                    <label id="label-image" class="col d-flex justify-content-center mt-2">
                                        <i>Logo</i>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center w-100 select_sponsor-new">
                        <div class="col-12 my-1 text-white">
                            <div class="form-group w-100">
                                <label for="sponsor_name">{{ __('sponsor.info.sponsor-name') }}</label>
                                <input type="text" id="sponsor_name" name="sponsor_name" class="select_sponsor-new"
                                    required placeholder="{{ __('sponsor.info.sponsor-name') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center w-100 select_sponsor-new">
                        <div class="col-12 my-1 text-white">
                            <div class="form-group w-100">
                                <label for="sponsor_introduce">{{ __('sponsor.info.sponsor-introduce') }}</label>
                                <textarea id="sponsor_introduce" name="sponsor_introduce" class="select_sponsor-new text-white" cols="30"
                                    rows="10" placeholder="{{ __('sponsor.info.sponsor-introduce') }}" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center w-100 select_sponsor-new">
                        <div class="col-12 my-1 text-white">
                            <div class="form-group w-100">
                                <label for="sponsor_link">{{ __('sponsor.info.sponsor-link') }}</label>
                                <input type="text" id="sponsor_link" name="sponsor_link" class="select_sponsor-new"
                                    required placeholder="Ex: https://fb.com/phamle21">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center w-100 select_sponsor-old">
                        <div class="col-12 my-1 text-white">
                            <div class="form-group w-100">
                                <label for="sponsor_name">{{ __('sponsor.info.sponsor-select-label') }}</label>
                                <select name="sponsor_select" class=" select_sponsor-old" id="sponsor_select" required>
                                    @foreach ($sponsor_list as $v)
                                        <option value="{{ $v->id }}" data-path="{{ $v->logo }}">
                                            {{ $v->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center w-100">
                        <div class="col-12 my-1 text-white">
                            <div class="form-group w-100">
                                <label for="sponsor_amount_input">{{ __('sponsor.info.sponsor-amount') }}</label>
                                <input type="number" id="sponsor_amount_input" name="sponsor_amount_input" min="1"
                                    required placeholder="{{ __('sponsor.info.sponsor-amount') }}">
                                <p id="sponsor_amount_show"></p>
                                <input type="hidden" readonly id="sponsor_amount" name="sponsor_amount" min="1"
                                    placeholder="{{ __('sponsor.info.sponsor-amount') }}">
                            </div>
                        </div>
                        <div class="col-12 my-1 text-white">
                            <label for="">{{ __('sponsor.info.sponsor-amount-type') }}</label>
                            <div class="row">
                                <div class="form-group col">
                                    <input type="radio" id="amount_type_usd" class="w-auto" name="sponsor_amount_type"
                                        value="usd">
                                    <label for="amount_type_usd"> USD</label>
                                </div>
                                <div class="form-group col">
                                    <input type="radio" id="amount_type_vnd" checked class="w-auto"
                                        name="sponsor_amount_type" value="vnd">
                                    <label for="amount_type_vnd"> VND</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-3 m-auto mb-5 mt-3 p-5 border border-white"
                    style="border-radius: 30px">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading">
                            <div class="row">
                                <h3>{{ __('sponsor.payment-card') }}</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <br>

                            <div class='form-row row my-2'>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>{{ __('sponsor.payment.name-of-card') }}</label>
                                    <input class='form-control' size='4' type='text' placeholder="">
                                </div>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>{{ __('sponsor.payment.card-number') }}</label>
                                    <input autocomplete='off' maxlength="16" class='form-control card-number' required
                                        size='20' type='text' placeholder="Ex: 4111 1111 1111 1111">
                                </div>
                            </div>
                            <div class='form-row row my-2'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>{{ __('sponsor.payment.CVC') }}</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                        required size='4' maxlength="4" type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>{{ __('sponsor.payment.expiration-month') }}</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                        maxlength="2" type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>{{ __('sponsor.payment.expiration-year') }}</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        required maxlength="4" type='text'>
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

    {{-- Upload logo --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
        function triggerInputFile(){
            $("#imageUpload").trigger('click');
        }
    </script>

    <script>
        function convert(val, type) {
            if (type == 'vnd') {
                $.ajax({
                    method: 'GET',
                    url: 'https://api.fastforex.io/convert',
                    data: jQuery.param({
                        api_key: "fb51c50a6b-ffbce0b7a3-rlonwu",
                        from: "USD",
                        to: "VND",
                        amount: 1,
                    }),
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(res) {
                        console.log(res);
                        const val = Number($('#sponsor_amount_input').val())
                        const rate = res.result.rate
                        const amountConvert = (val / rate).toFixed(2)

                        $('#sponsor_amount').val(amountConvert)
                        $('#sponsor_amount_show').html(`<i>${val} VND = $${amountConvert}</i>`)
                    },
                    error: function(error) {
                        console.log("error: ", error);
                    }
                })
            } else {
                const val = Number($('#sponsor_amount_input').val())
                $('#sponsor_amount').val(val)
                $('#sponsor_amount_show').html("$" + val)

            }
        }
        $('#sponsor_amount_input').change(function() {
            if ($('#amount_type_vnd').is(':checked')) {
                const val = Number($('#sponsor_amount_input').val())
                convert(val, 'vnd')
            } else {
                const val = Number($('#sponsor_amount_input').val())
                convert(val, 'usd')
            }

        })
        $('#amount_type_vnd').click(function() {
            const val = Number($('#sponsor_amount_input').val())
            convert(val, 'vnd')
        })
        $('#amount_type_usd').click(function() {
            const val = Number($('#sponsor_amount_input').val())
            convert(val, 'usd')
        })
    </script>
    <script>
        $('.select_sponsor-new').removeClass('d-none')
        $('.select_sponsor-old').addClass('d-none')

        function changeStatusSponsor(value) {
            if (value == "new") {
                $('.select_sponsor-new').removeClass('d-none')
                $('.select_sponsor-old').addClass('d-none')

                $('.select_sponsor-new').attr('disabled', false)
                $('.select_sponsor-old').attr('disabled', true)
            } else {
                $('.select_sponsor-new').addClass('d-none')
                $('.select_sponsor-old').removeClass('d-none')

                $('.select_sponsor-new').attr('disabled', true)
                $('.select_sponsor-old').attr('disabled', false)
            }
        }
    </script>

    <script>
        var selection = document.getElementById("sponsor_select");

        selection.onchange = function(event) {
            var path = event.target.options[event.target.selectedIndex].dataset.path;

            $('#imagePreview').css('background-image', 'url(' + path + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        };
    </script>
@endsection
