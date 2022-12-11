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
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form"
                enctype='multipart/form-data'>
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
                                        <div id="imagePreview" onclick="triggerInputFile()"
                                            style="background-image: url('');">
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
                                <label for="sponsor_amount_show">{{ __('sponsor.info.sponsor-amount') }} (VND)</label>
                                <input type="text" id="sponsor_amount_show" name="sponsor_amount_show" min="1"
                                    required placeholder="{{ __('sponsor.info.sponsor-amount') }}"
                                    onkeyup="inputAmount(this.value)">

                                <input type="hidden" id="sponsor_amount" name="sponsor_amount" min="1">

                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center align-items-center w-100">
                        <div class="col-12 my-1 text-white">
                            <div class="form-group w-100">
                                <label for="">{{ __('sponsor.info.sponsor-payment-method') }}</label>
                                <div>
                                    <input type="radio" id="method_stripe" checked class="w-auto"
                                        name="payment_method" value="stripe" required>
                                    <label for="method_stripe">Stripe</label>
                                </div>
                                <div>
                                    <input type="radio" id="method_paypal" class="w-auto" name="payment_method"
                                        value="paypal" required>
                                    <label for="method_paypal">Paypal (bảo trì)</label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-row row mt-4">
                        <div class="col-xs-12 ">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" form="payment-form"
                                type="submit">{{ __('sponsor.payment.btn-submit') }}</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    </body>
@endsection

@section('js')
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

        function triggerInputFile() {
            $("#imageUpload").trigger('click');
        }
    </script>

    <script>
        $('.select_sponsor-new').removeClass('d-none')
        $('.select_sponsor-old').addClass('d-none')
        $('.select_sponsor-new').attr('disabled', false)
        $('.select_sponsor-old').attr('disabled', true)

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.2.6/jquery.inputmask.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sponsor_amount_show").inputmask({
                alias: "currency",
                prefix: ' VNĐ ',
                digits: 0,
            });
        });
    </script>
    <script>
        function inputAmount(value) {
            console.log(value)
            $('#sponsor_amount').val(value)
            $("#sponsor_amount").inputmask({
                alias: "currency",
                prefix: ' VNĐ ',
                digits: 0,
            });
            $('#sponsor_amount').inputmask('remove');
        }
    </script>
@endsection
