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
            <form action="{{ route('matches.create') }}" id="frmNewMatches" method="POST">
                @csrf
                <input type="hidden" readonly id="league_id" name="league_id" value="{{ $tournament->id }}">
                <input type="hidden" readonly id="inputStageId" name="group_id">
                <i class="text-warning">
                    Bạn có thể đặt sân cho trận đấu thông qua thanh toán online:
                    <a href="#">Đặt sân</a>
                </i>
                <div class="form-group my-3">
                    <label for="matchesName">Ngày thi đấu *:</label>
                    <input type="datetime-local" class="text-white" id="matchesName" name="match_date" required>
                </div>

                <div class="form-group my-3">
                    <label for="team">Đội đấu *:</label>
                    <select name="team_id" id="team">
                    </select>
                </div>

                <div class="form-group my-3">
                    <label for="opposing-team">Đội đối đầu *:</label>
                    <select name="team_opposing_id" id="opposing-team">
                    </select>
                    <small>
                        <i>Nếu không có team nào hãy thêm team cho mùa giải của bạn:
                            <u><a href="{{ route('team.create') }}">Tạo team</a></u>
                        </i>
                    </small>
                </div>

                <div class="form-group my-3">
                    <label for="location">Địa điểm :</label>
                    <input type="text" class="text-white" id="location" name="location">
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
