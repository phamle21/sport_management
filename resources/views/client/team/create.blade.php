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
    <style>
        .select2-container {
            width: 100% !important;
            color: white !important;
        }

        .select2-selection {
            -webkit-border-radius: 3px !important;
            -moz-border-radius: 3px !important;
            border-radius: 3px !important;
            outline: none !important;
            border: 1px solid rgba(255, 255, 255, .1) !important;
            background: rgba(255, 255, 255, .1) !important;
            color: white !important;
        }

        .select2-selection__rendered,
        .select2-search__field {
            color: white !important;

        }

        .select2-dropdown--below,
        .select2-dropdown--above {
            background: #282b48 !important;

        }

        .select2-selection__choice {
            background-color: transparent !important;
        }

        .select2-selection--multiple {
            min-height: 3rem;
        }

        #select2-select_league-container {
            display: flex !important;
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
                            <h2 class="mb-5">{{ __('message.team.create.head') }}</h2>

                            <form class="contact-form justify-content-center" action="{{ route('team.store') }}"
                                id="frmCreateTeam" name="frmCreateTeam" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row flex-column justify-content-center align-items-center w-100">
                                    <div class="col">
                                        <div class="container">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="image_logo" required
                                                        accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview"
                                                    onclick="(function(){$('#imageUpload').trigger('click')})()">
                                                    <div id="imagePreview" style="background-image: url('');">
                                                    </div>
                                                </div>
                                                <label id="label-image" class="col d-flex justify-content-start mt-2">
                                                    <p class="text-warning"></p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group w-100 d-flex flex-column align-items-start">
                                            <label for="name">{{ __('message.team.create.frm-name') }}*:</label>
                                            <input type="text" id="name" name="name" required
                                                placeholder="{{ __('message.team.create.frm-name') }}">
                                        </div>
                                        <div class="form-group w-100 d-flex flex-column align-items-start">
                                            <label for="select_league">{{ __('message.team.create.frm-league') }}*:</label>
                                            <select name="league_id" id="select_league">
                                                @foreach (\App\Models\League::all() as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group w-100 d-flex flex-column align-items-start">
                                            <label for="user_ids">{{ __('message.team.create.frm-users') }}*:</label>
                                            <select name="user_ids[]" id="user_ids" multiple>
                                                @foreach (\App\Models\User::all() as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group w-100 text-center mt-4">
                                    <button class="default-button" id="btn-frmCreateTeam" from="frmCreateTeam"
                                        type="submit">
                                        <span>
                                            {{ __('message.team.create.btn-send') }}
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
        $('#btn-frmCreateTeam').on('click', function() {

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
    <script>
        $('#user_ids').select2();
        $('#select_league').select2();
    </script>
@endsection
