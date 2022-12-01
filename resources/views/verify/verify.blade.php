@extends('client.master.template')

@section('body_content')
    <div class="row justify-content-center align-items-center my-5 w-100">
        <div class="col d-flex flex-column align-items-center">
            <h2>Xác thực email</h2>

            <br>
            <br>
            <br>
            <br>
            <p>Vui lòng kiểm tra email và xác thực tài khoản!</p>
            <br>
            <br>
            <br>
            <br>

            <p id="show1" class="d-none">Gửi lại sau <span id="show-seconds"></span></p>
            <p id="show2" class="d-none"></p>
            <p id="re-send">
                Nếu bạn chưa nhận được email, <i><a href="javascript:;" onclick="countDown()">Gửi lại</a></i>
            </p>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function startTimer(duration, display) {
            var timer = duration,
                minutes, seconds;
            setInterval(function() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        function countDown() {
            $('#show2').removeClass('d-none');
            $('#show2').html('Đang gửi...');
            $('#re-send').addClass('d-none')

            $.ajax({
                type: 'POST',
                url: "{{ route('verification.send') }}",
                success: function() {
                    $('#show2').addClass('d-none');
                    $('#show1').removeClass('d-none')

                    timeLeft = 60;

                    function callback() {
                        timeLeft--;

                        $('#show-seconds').html(timeLeft)

                        if (timeLeft > 0) {
                            $('#re-send').removeClass('d-none')
                            $('#show1').addClass('d-none')
                            setTimeout(callback, 1000);
                        }
                    };

                    setTimeout(callback, 1000);
                }
            })
        }
    </script>
@endsection
