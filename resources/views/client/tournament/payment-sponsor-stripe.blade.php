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
    <style>
        .securepay-ui-iframe {
            width: 100%;
            border: 1px solid;
            border-radius: 30px;
            height: 19rem !important;
            display: flex;
            background-color: white;
            padding: 2rem
        }

        #main {
            background-color: #FFFFFF;
            padding: 21px;
        }

        .second-btn {
            background: transparent;
            color: #000;
            border-color: #000;
            border-style: solid;
            border-width: thin;
        }

        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url("https://www.mcsafootball.org.au/payments/loading.gif") no-repeat center center;
            z-index: 10000;
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
            @php
                $isProd = false;
                if ($isProd == false) {
                    $clientId = '0oaxb9i8P9vQdXTsn3l5';
                    $merchantCode = '5AR0055';
                }
            @endphp
            <form onsubmit="return false;">
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="sponsor_id" value="{{ $sponsor_id }}">
                <input type="hidden" name="league_id" value="{{ $league_id }}">
                <div id="securepay-ui-container"></div>
                <button id="btn-submit" class="btn btn-primary m-3" type="submit" onclick="tokenise()">Submit</button>
                <button id="btn-reset" class="btn btn-success m-3" onclick="tokenReset()" class="second-btn">Reset</button>
            </form>

        </div>
    </div>
    <div id="loader"></div>

    </body>
@endsection

@section('js')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <?php if ($isProd == FALSE) : ?>
    <script id="securepay-ui-js" src="https://payments-stest.npe.auspost.zone/v3/ui/client/securepay-ui.min.js"></script>
    <?php else : ?>
    <script id="securepay-ui-js" src="https://payments.auspost.net.au/v3/ui/client/securepay-ui.min.js"></script>
    <?php endif; ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script type="text/javascript">
        jQuery.noConflict();

        var mySecurePayUI;

        jQuery(document).ready(function() {
            var spinner = jQuery('#loader');
            // spinner.hide();

            mySecurePayUI = new securePayUI.init({
                containerId: 'securepay-ui-container',
                scriptId: 'securepay-ui-js',
                clientId: '<?= $clientId ?>',
                merchantCode: '<?= $merchantCode ?>',
                card: { // card specific config options / callbacks
                    showCardIcons: true,

                    onTokeniseSuccess: function(tokenisedCard) {
                        spinner.show();
                        jQuery.ajax({
                            type: "POST",
                            url: "{{ route('sponsor.processing.stripe') }}",
                            // 	contentType: "application/json",
                            dataType: 'json',
                            data: {
                                'token': tokenisedCard['token'],
                                'scheme': tokenisedCard['scheme'],
                                'mode': '<?php echo $isProd ? 'prod' : 'test'; ?>',
                                'amount': '<?= $amount ?>',
                                'sponsor_id': '<?= $sponsor_id ?>',
                                'league_id': '<?= $league_id ?>',

                            },
                            success: function(data) {
                                spinner.hide();

                                if (data.status == 'error') {
                                    Toastify({
                                        text: 'Error: ' + data.message,
                                        position: 'right',
                                        gravity: 'top',
                                        style: {
                                            background: '#ff3366',
                                        }
                                    }).showToast();
                                } else {
                                    Toastify({
                                        text: 'Success: Thanh toán thành công',
                                        position: 'right',
                                        gravity: 'top',
                                        style: {
                                            background: '#00d06f',
                                        }
                                    }).showToast();
                                    setTimeout(function() {
                                        window.location.href = "/tournament/<?= $league_id ?>/details"
                                    }, 1000)
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {

                                spinner.hide();

                                if (textStatus == 'timeout') {
                                    Toastify({
                                        text: 'Error : Timeout for this call!',
                                        position: 'right',
                                        gravity: 'top'
                                    }).showToast();

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000)
                                }
                                console.log(errorThrown)
                                Toastify({
                                    text: 'Error Call Processing',
                                    position: 'right',
                                    gravity: 'top'
                                }).showToast();
                            },
                            timeout: 10000
                        });
                    },
                    onTokeniseError: function(errors) {

                        console.log('Error while tokenising card');
                        // error while tokenising card
                        console.log({
                            errors
                        });
                        jQuery('#btn-submit').attr('disabled', false);
                        jQuery('#btn-reset').attr('disabled', false);
                    }
                },
                style: {
                    backgroundColor: 'transparent',
                    padding: '5rem',
                    label: {
                        font: {
                            family: 'Arial, Helvetica, sans-serif',
                            size: '1.1rem',
                            color: 'darkblue',
                            margin: '1rem'
                        }
                    },
                    input: {
                        font: {
                            family: 'Arial, Helvetica, sans-serif',
                            size: '1.1rem',
                            color: 'darkblue',
                            margin: '1rem'
                        }
                    }
                },
            });
        });

        function tokenise() {
            mySecurePayUI.tokenise();
        }

        function tokenReset() {
            mySecurePayUI.reset();
        }
    </script>
@endsection
