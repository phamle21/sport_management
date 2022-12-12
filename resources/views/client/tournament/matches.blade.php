@extends('client.master.template')

@section('css')
@endsection

@section('body_content')
    <!-- ===========Achievements Section Start Here========== -->
    <div class="achievement-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header">
                <p>{{ $tournament->name }}</p>
                <h2 class="mb-3">Chi tiết trận đấu</h2>
            </div>
            <div class="section-wrapper">
                <div class="achievement-area">

                    <ul class="nav nav-tabs align-items-center" id="myTab" role="tablist">
                        <li class="nav-item mx-3" role="presentation" title="ALL">
                            <button class="nav-link active" id="tabAll-tab" data-bs-toggle="tab" data-bs-target="#tabAll"
                                type="button" role="tab" aria-controls="tabAll" aria-selected="true">
                                <img src="{{ asset($tournament->logo) }}" alt="achievement">
                            </button>
                        </li>
                        <li class="nav-item mx-3" role="presentation" title="Rockstar Games">
                            <button class="nav-link" id="tabTwo-tab" data-bs-toggle="tab" data-bs-target="#tabTwo"
                                type="button" role="tab" aria-controls="tabTwo" aria-selected="false">
                                <img src="{{ asset($team1->logo) }}" alt="achievement">
                                <span style="font-size:12px!important">{{ $team1->name }}</span>
                            </button>
                        </li>
                        <li class="nav-item mx-3" role="presentation" title="Valorant">
                            <button class="nav-link" id="tabThree-tab" data-bs-toggle="tab" data-bs-target="#tabThree"
                                type="button" role="tab" aria-controls="tabThree" aria-selected="false">
                                <img src="{{ asset($team2->logo) }}" alt="achievement">
                                <span style="font-size:12px!important">{{ $team2->name }}</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabAll" role="tabpanel" aria-labelledby="tabAll-tab">
                            <table class="table text-white">
                                <thead>
                                    <tr>
                                        <th>Chỉ số</th>
                                        <th>Giá trị</th>
                                        @if ($tournament->user_id == Auth::user()->id)
                                            <th>Thao tác</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (is_array($match->indicators))
                                        @foreach ($match->indicators as $k => $v_indicator)
                                            <tr>
                                                <td>{{ $v_indicator['key'] }}</td>
                                                <td>{{ $v_indicator['value'] }}</td>
                                                @if ($tournament->user_id == Auth::user()->id)
                                                    <td>
                                                        <div class="row">

                                                            <div class="col">

                                                                <form
                                                                    action="{{ route('keymatch.delete', ['match_id' => $match->id, 'key' => $v_indicator['key']]) }}"
                                                                    id="frmDeleteKeyMatch-{{ $match->id }}-{{ $k }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="league_id"
                                                                        value="{{ $tournament->id }}">
                                                                    <button class="bg-transparent btn text-white fs-6"
                                                                        type="button"
                                                                        onclick="deleteKeyMatch('{{ $k }}')">
                                                                        <i class="fa-duotone fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-center ">
                                            <div class="row">
                                                <div class="col">
                                                    <a data-bs-toggle="modal" data-bs-target="#new-keymatch"
                                                        style="cursor: pointer;" class="accordion-header w-100 view-modal">
                                                        <b>Thêm</b>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tabTwo" role="tabpanel" aria-labelledby="tabTwo-tab">
                            <table class="table text-white">
                                <thead>
                                    <tr>
                                        <th>Chỉ số</th>
                                        <th>Giá trị</th>
                                        @if ($tournament->user_id == Auth::user()->id)
                                            <th>Thao tác</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (is_array($team1_details->indicators))
                                        @foreach ($team1_details->indicators as $k => $v_indicator)
                                            <tr>
                                                <td>{{ $v_indicator['key'] }}</td>
                                                <td>{{ $v_indicator['value'] }}</td>
                                                @if ($tournament->user_id == Auth::user()->id)
                                                    <td>
                                                        <div class="row">

                                                            <div class="col">

                                                                <form
                                                                    action="{{ route('keyteam.delete', ['match_id' => $match->id, 'key' => $v_indicator['key']]) }}"
                                                                    id="frmDeleteKeyTeam1-{{ $team1_details->id }}-{{ $k }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="team_id"
                                                                        value="{{ $team1_details->id }}">
                                                                    <button class="bg-transparent btn text-white fs-6"
                                                                        type="button"
                                                                        onclick="deleteKeyTeam1('{{ $k }}')">
                                                                        <i class="fa-duotone fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-center ">
                                            <div class="row">
                                                <div class="col">
                                                    <a data-bs-toggle="modal" data-bs-target="#new-keyteam1"
                                                        style="cursor: pointer;"
                                                        class="accordion-header w-100 view-modal">
                                                        <b>Thêm</b>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tabThree" role="tabpanel" aria-labelledby="tabThree-tab">
                            <table class="table text-white">
                                <thead>
                                    <tr>
                                        <th>Chỉ số</th>
                                        <th>Giá trị</th>
                                        @if ($tournament->user_id == Auth::user()->id)
                                            <th>Thao tác</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (is_array($team2_details->indicators))
                                        @foreach ($team2_details->indicators as $k => $v_indicator)
                                            <tr>
                                                <td>{{ $v_indicator['key'] }}</td>
                                                <td>{{ $v_indicator['value'] }}</td>
                                                @if ($tournament->user_id == Auth::user()->id)
                                                    <td>
                                                        <div class="row">

                                                            <div class="col">

                                                                <form
                                                                    action="{{ route('keyteam.delete', ['match_id' => $match->id, 'key' => $v_indicator['key']]) }}"
                                                                    id="frmDeleteKeyTeam2-{{ $team2_details->id }}-{{ $k }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="team_id"
                                                                        value="{{ $team2_details->id }}">
                                                                    <button class="bg-transparent btn text-white fs-6"
                                                                        type="button"
                                                                        onclick="deleteKeyTeam2('{{ $k }}')">
                                                                        <i class="fa-duotone fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-center ">
                                            <div class="row">
                                                <div class="col">
                                                    <a data-bs-toggle="modal" data-bs-target="#new-keyteam2"
                                                        style="cursor: pointer;"
                                                        class="accordion-header w-100 view-modal">
                                                        <b>Thêm</b>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===========Achievements Section Ends Here========== -->

    <!-- Modal new Key Match-->
    <div id="new-keymatch" class="modal fade text-white" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgba(35, 42, 92);">
                <div class="modal-header ">
                    <h1 class="modal-title mt-0 fs-5 text-white" id="exampleModalLabel">Chỉ số mới cho trận đấu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white">
                    <form action="{{ route('keymatch.create', ['match_id' => $match->id]) }}" id="frmNewKeyMatches"
                        method="POST">
                        @csrf

                        <div class="form-group my-3">
                            <label for="key_indicator">Tên chỉ số :</label>
                            <input type="text" class="text-white" id="key_indicator" name="key_indicator">
                        </div>

                        <div class="form-group my-3">
                            <label for="value_indicator">Giá trị :</label>
                            <input type="text" class="text-white" id="value_indicator" name="value_indicator">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" form="frmNewKeyMatches" class="btn btn-primary">Thêm chỉ số mới</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal new Key Team 1-->
    <div id="new-keyteam1" class="modal fade text-white" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgba(35, 42, 92);">
                <div class="modal-header ">
                    <h1 class="modal-title mt-0 fs-5 text-white" id="exampleModalLabel">Chỉ số mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white">
                    <form action="{{ route('keyteam.create', ['match_id' => $match->id]) }}" id="frmNewKeyTeam1"
                        method="POST">
                        @csrf

                        <input type="hidden" name="team_id" value="{{ $match->team_id }}">

                        <div class="form-group my-3">
                            <label for="key_indicator">Tên chỉ số :</label>
                            <input type="text" class="text-white" id="key_indicator" name="key_indicator">
                        </div>

                        <div class="form-group my-3">
                            <label for="value_indicator">Giá trị :</label>
                            <input type="text" class="text-white" id="value_indicator" name="value_indicator">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" form="frmNewKeyTeam1" class="btn btn-primary">Thêm chỉ số mới</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal new Key Team 2-->
    <div id="new-keyteam2" class="modal fade text-white" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: rgba(35, 42, 92);">
                <div class="modal-header ">
                    <h1 class="modal-title mt-0 fs-5 text-white" id="exampleModalLabel">Chỉ số mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-white">
                    <form action="{{ route('keyteam.create', ['match_id' => $match->id]) }}" id="frmNewKeyTeam2"
                        method="POST">
                        @csrf

                        <input type="hidden" name="team_id" value="{{ $match->team_opposing_id }}">

                        <div class="form-group my-3">
                            <label for="key_indicator">Tên chỉ số :</label>
                            <input type="text" class="text-white" id="key_indicator" name="key_indicator">
                        </div>

                        <div class="form-group my-3">
                            <label for="value_indicator">Giá trị :</label>
                            <input type="text" class="text-white" id="value_indicator" name="value_indicator">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" form="frmNewKeyTeam2" class="btn btn-primary">Thêm chỉ số mới</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function deleteKeyMatch(id) {

            Swal.fire({
                title: 'Xóa',
                html: 'Bạn muốn xóa chỉ số này?',
                iconHtml: '<img src="https://i.pinimg.com/originals/ff/fa/9b/fffa9b880767231e0d965f4fc8651dc2.gif" style="max-width: 12rem" alt="icon-delete"/>',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: `Xóa`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isDenied) {
                    $('#frmDeleteKeyMatch-{{ $match->id }}-' + id).submit();
                }
            })
        }

        function deleteKeyTeam1(id) {

            Swal.fire({
                title: 'Xóa',
                html: 'Bạn muốn xóa chỉ số này?',
                iconHtml: '<img src="https://i.pinimg.com/originals/ff/fa/9b/fffa9b880767231e0d965f4fc8651dc2.gif" style="max-width: 12rem" alt="icon-delete"/>',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: `Xóa`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isDenied) {
                    $('#frmDeleteKeyTeam1-{{ $team1_details->id }}-' + id).submit();
                }
            })
        }

        function deleteKeyTeam2(id) {

            Swal.fire({
                title: 'Xóa',
                html: 'Bạn muốn xóa chỉ số này?',
                iconHtml: '<img src="https://i.pinimg.com/originals/ff/fa/9b/fffa9b880767231e0d965f4fc8651dc2.gif" style="max-width: 12rem" alt="icon-delete"/>',
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: `Xóa`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isDenied) {
                    $('#frmDeleteKeyTeam2-{{ $team2_details->id }}-' + id).submit();
                }
            })
        }
    </script>
@endsection
