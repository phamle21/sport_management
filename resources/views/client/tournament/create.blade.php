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
    </style>


    <style>
        #form-group-ckeditor .ck-rounded-corners {
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 4px;
            box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 6%);
            background: rgba(35, 42, 92, .5);
            color: #fff;
            min-height: 15rem;
        }

        .ck-sticky-panel__content {
            background: rgba(35, 42, 92, .5);
            color: #fff;
        }
    </style>
    <style>
        .btn-add {
            border: 1px solid rgba(255, 255, 255, .1) !important;
            color: #fff;
            padding: 1rem;
            margin-left: 0.5rem;
        }

        .btn-add:hover {
            color: #fff;
            background: rgba(35, 42, 92, 0.833);
        }
    </style>
@endsection

@section('body_content')
    <div class="contact-section">
        <div class="contact-top padding-top padding-bottom bg-attachment"
            style="background-image:url(assets/images/video/bg.jpg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <div class="contact-form-wrapper text-center">
                            <h2 class="mb-5">{{ __('message.tournament.create.head') }}</h2>

                            <form class="contact-form justify-content-center" action="{{ route('tournament.create') }}"
                                id="frmCreateTournament" name="frmCreateTournament" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col">
                                        <div class="container">

                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="image"
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url('https://cdn.dribbble.com/users/1787323/screenshots/6087799/attachments/1306352/sport2-02.png?compress=1&resize=400x300&vertical=top');">
                                                    </div>
                                                </div>
                                                <label id="label-image" class="col d-flex justify-content-start mt-2">
                                                    <p class="text-warning"></p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group w-100">
                                            <input type="text" id="name" name="name" required
                                                placeholder="{{ __('message.tournament.create.frm-name') }}">
                                        </div>
                                        <div class="form-group w-100 d-flex align-items-center">
                                            <select name="type" id="select_type" required>
                                                <option disabled selected value="-1">
                                                    {{ __('message.tournament.create.frm-type') }} *</option>
                                                @foreach ($league_type_list as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }} </option>
                                                @endforeach
                                            </select>
                                            <input type="text" id="new_type" name="type" disabled class="d-none"
                                                placeholder="{{ __('message.tournament.create.frm-type') }} *">
                                            <button class="btn btn-add border" id="btn-add_tournament_type"
                                                type="button"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-add border d-none" id="btn-toggle_tournament_type"
                                                type="button"><i class="fa-solid fa-arrows-rotate"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col">
                                        <div class="form-group w-100">
                                            <input type="text" id="start" name="start" required
                                                data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"
                                                placeholder="{{ __('message.tournament.create.frm-start') }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group w-100">
                                            <input type="text" id="end" name="end" required
                                                data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"
                                                placeholder="{{ __('message.tournament.create.frm-end') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col-12">
                                        <div class="form-group w-100">
                                            <textarea class="form-control" id="description" rows="4" maxlength=300
                                                placeholder="{{ __('message.tournament.create.frm-des') }}" name="description"></textarea>
                                        </div>
                                    </div>

                                    <label for="notify" id="label-notify"
                                        class="col d-flex justify-content-start ">{{ __('message.tournament.create.frm-notify') }}
                                        *: <p class="text-warning"></p></label>
                                    <div class="col-12">
                                        <div class="form-group w-100" id="form-group-ckeditor">
                                            <textarea class="form-control" id="notify" rows="8"
                                                placeholder="{{ __('message.tournament.create.frm-notify') }}" name="notify"></textarea>
                                        </div>
                                    </div>

                                    <label for="prize" id="label-prize"
                                        class="col d-flex justify-content-start ">{{ __('message.tournament.create.frm-prize') }}
                                        *: <p class="text-warning"></p></label>
                                    <div class="col-12">
                                        <div class="form-group w-100" id="form-group-ckeditor">
                                            <textarea class="form-control" id="prize" rows="8"
                                                placeholder="{{ __('message.tournament.create.frm-prize-placeholder') }}" name="prize"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group w-100 text-center mt-4">
                                    <button class="default-button" id="btn-frmCreateTournament"
                                        from="frmCreateTournament" type="submit">
                                        <span>{{ __('message.tournament.create.btn-send') }}
                                            <i class="icofont-circled-right"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <p class="form-message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- check submit  --}}
    <script>
        $('#btn-frmCreateTournament').on('click', function() {

            if ($('#imageUpload').get(0).files.length === 0) {
                $('#label-image p').empty()
                $('#label-image p').append('&nbsp;&nbsp;Không thể để trống');
            } else {
                $('#label-image p').empty()
            }


        })
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
    </script>

    {{-- Input mask --}}
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/dependencyLibs/inputmask.dependencyLib.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.js"></script>
    <script src="https://unpkg.com/inputmask@4.0.4/dist/inputmask/inputmask.date.extensions.js"></script>
    <script>
        Inputmask().mask("input");
    </script>

    {{-- required ui, windowload --}}
    <script>
        $('input').each(function() {
            if ($(this).attr('required')) {
                $(this).attr('placeholder', `${$(this).attr('placeholder')} *`)
            }
        })
    </script>

    {{-- new tournament type --}}
    <script>
        $('#btn-add_tournament_type').click(function() {
            $('#new_type').removeClass('d-none').attr({
                'disabled': false,
                'required': true
            });
            $('#select_type').addClass('d-none').attr({
                'disabled': true,
                'required': false
            });
            $(this).addClass('d-none')
            $('#btn-toggle_tournament_type').removeClass('d-none')
        })

        $('#btn-toggle_tournament_type').click(function() {
            $('#new_type').addClass('d-none').attr({
                'disabled': true,
                'required': false
            });
            $('#select_type').removeClass('d-none').attr({
                'disabled': false,
                'required': true
            });
            $(this).addClass('d-none')
            $('#btn-add_tournament_type').removeClass('d-none')
        })
    </script>

    {{-- CK_Editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#notify'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#prize'), {
                ckfinder: {
                    uploadUrl: "{{ route('image.upload') . '?_token=' . csrf_token() }}",
                },
                mediaEmbed: {
                    previewsInData: true
                }
            }).catch(error => {
                console.error(error);
            });
    </script>
@endsection
