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

    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

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

                            @if (\Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {!! \Session::get('success') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (\Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {!! \Session::get('error') !!}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form class="contact-form justify-content-center" action="{{ route('tournament.create') }} "
                                id="frmCreateTournament" method="POST">
                                @csrf

                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col">
                                        <div class="container">

                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="image"
                                                        accept=".png, .jpg, .jpeg" required />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url({{ asset(\App\Models\Option::where('name', 'logo_site_path')->first()->value) }});">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group w-100">
                                            <input type="text" id="name" name="name"
                                                placeholder="{{ __('message.tournament.create.frm-name') }}" required>
                                        </div>
                                        <div class="form-group w-100">
                                            <select name="type" id="type" required>
                                                <option disabled selected value="-1">
                                                    {{ __('message.tournament.create.frm-type') }}</option>
                                                @foreach ($league_type_list as $v)
                                                    <option value="{{ $v->id }}">{{ $v->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col">
                                        <div class="form-group w-100">
                                            <input type="text" id="start" name="start"
                                                data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"
                                                placeholder="{{ __('message.tournament.create.frm-start') }}" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group w-100">
                                            <input type="text" id="end" name="end"
                                                data-inputmask="'alias': 'datetime', 'inputFormat': 'dd/mm/yyyy'"
                                                placeholder="{{ __('message.tournament.create.frm-end') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center align-items-center w-100">
                                    <div class="col">
                                        <div class="form-group w-100" id="form-group-ckeditor">
                                            <textarea class="form-control" id="rule" rows="8"
                                                placeholder="{{ __('message.tournament.create.frm-rule') }}" name="rule" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group w-100 text-center mt-4">
                                    <button class="default-button" from="frmCreateTournament"type="submit">
                                        <span>{{ __('message.contact.btn-send') }}
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

    {{-- CK_Editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#rule'), {
                ckfinder: {
                    uploadUrl: '{{ route('image.upload') . '?_token=' . csrf_token() }}',
                }
            }).catch(error => {
                console.error(error);
            });
    </script>
@endsection
