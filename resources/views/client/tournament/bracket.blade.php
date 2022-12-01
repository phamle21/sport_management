<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<!-- basic styles -->
<style type="text/css">
    h1 {
        margin: 150px auto 30px auto;
        text-align: center;
    }

    canvas {}

    .g_gracket {
        width: max-content;
        background-color: rgba(72, 42, 42, 0);
        padding: 55px 15px 5px;
        line-height: 100%;
        position: relative;
        overflow: hidden;
    }

    .g_round {
        float: left;
        margin-right: 70px;
    }

    .g_game {
        position: relative;
        margin-bottom: 15px;
    }

    .g_gracket h3 {
        margin: 0;
        padding: 10px 8px 8px;
        font-size: 18px;
        font-weight: normal;
        color: #fff
    }

    .g_team {
        background: #3597AE;
    }

    .g_team:last-child {
        background: #FCB821;
    }

    .g_round:last-child {
        margin-right: 20px;
    }

    .g_winner {
        background: #444;
    }

    .g_winner .g_team {
        background: none;
    }

    .g_current {
        cursor: pointer;
        background: #A0B43C !important;
    }

    .g_round_label {
        top: 0px;
        font-weight: normal;
        color: #CCC;
        text-align: center;
        font-size: 18px;
        margin-left: 60px;
    }
</style>

<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>

<!-- main lib -->
<script type="text/javascript" src="{{ asset('assets/js/jquery.gracket.min.js') }}"></script>
<script type="text/javascript">
    (function(win, doc, $) {

        var passes = 0;
        var fails = 0;
        var counter = 1;
        win.tests = {};

        // home grown tester
        function describe(description, callback) {
            tests[description] = function() {
                var result = (callback() === true) ? true : false;
                fails = fails + (result ? 0 : 1);
                passes = passes + (!result ? 0 : 1);
                return console[result ? "info" : "error"](counter++ + " - " + description + ": " + (result ?
                    "Pass" : "Fail"));
            };
            tests[description]();
        };

        // tests
        $(function() {

            console.log("\n\njquery.gracket.js Tests Started!\n\n");

            describe("jQuery is loaded", function() {
                return typeof $ !== "undefined";
            });

            describe("The total rounds (in TestData) should equal 5", function() {
                return win.TestData.length === 5;
            });

            describe("Works with jQuery version 1.8.2", function() {
                return $().jquery === "1.8.2";
            });

            describe("Player width should be greater than or equal to minWidth", function() {
                var playerWidth = $(".sammy-zettersten").eq(0).outerWidth(true);
                var minWidth = +($(".my_gracket h3").eq(0).css("minWidth").replace("px", ""));
                return playerWidth >= minWidth;
            });

            describe("Player 'Erik Zettersten' should be the only node at the fith round position",
                function() {
                    return ($(".g_winner h3").text().replace(/1\s/g, "").toLowerCase()) ===
                        "erik zettersten";
                });

            //tbc...
            console.log("\nThere were " + passes + " Passes and " + fails +
                " fails!\njquery.gracket.js Tests Completed!\n\n");

        });

    })(window, document, jQuery);
</script>

<style>
    .g_team h3 {
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="my_gracket"></div>

<script type="text/javascript">
    (function(win, doc, $) {

        console.warn(
            "Make sure the min-width of the .gracket_h3 element is set to width of the largest name/player. Gracket needs to build its canvas based on the width of the largest element. We do this my giving it a min width. I'd like to change that!"
        );

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: '/tournament-bracket',
            data: {
                league_id: "{{ $tournament->id }}"
            },
            success: function(res) {
                console.log(res)
                $(".my_gracket").gracket({
                    src: res.data,
                    roundLabels : res.rounds
                });
            }
        })
        // $(".my_gracket").gracket({
        //     src: win.TestData
        // });

    })(window, document, jQuery);
</script>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
            '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>
