<?php
include './koneksi.php';

$get_team = mysqli_query($conn, "SELECT * FROM team ORDER BY poin DESC");
$fetch_value = mysqli_fetch_assoc($get_team);
if ($fetch_value['poin'] == 0) {
    header('location: ./index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <title>KOMPETISI SELESAI</title>

    <style>
        @keyframes confetti-slow {
            0% {
                transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
            }

            100% {
                transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
            }
        }

        @keyframes confetti-medium {
            0% {
                transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
            }

            100% {
                transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
            }
        }

        @keyframes confetti-fast {
            0% {
                transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
            }

            100% {
                transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
            }
        }

        .confetti-container {
            perspective: 700px;
            position: absolute;
            overflow: hidden;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        /* Checkmark */
        .checkmark-circle {
            width: 150px;
            height: 150px;
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin-left: auto;
            margin-right: auto;
        }

        .checkmark-circle .background {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #00C09D;
            position: absolute;
        }

        .checkmark-circle .checkmark {
            border-radius: 5px;
        }

        .checkmark-circle .checkmark.draw:after {
            -webkit-animation-delay: 100ms;
            -moz-animation-delay: 100ms;
            animation-delay: 100ms;
            -webkit-animation-duration: 3s;
            -moz-animation-duration: 3s;
            animation-duration: 3s;
            -webkit-animation-timing-function: ease;
            -moz-animation-timing-function: ease;
            animation-timing-function: ease;
            -webkit-animation-name: checkmark;
            -moz-animation-name: checkmark;
            animation-name: checkmark;
            -webkit-transform: scaleX(-1) rotate(135deg);
            -moz-transform: scaleX(-1) rotate(135deg);
            -ms-transform: scaleX(-1) rotate(135deg);
            -o-transform: scaleX(-1) rotate(135deg);
            transform: scaleX(-1) rotate(135deg);
            -webkit-animation-fill-mode: forwards;
            -moz-animation-fill-mode: forwards;
            animation-fill-mode: forwards;
        }

        .checkmark-circle .checkmark:after {
            opacity: 1;
            height: 75px;
            width: 37.5px;
            -webkit-transform-origin: left top;
            -moz-transform-origin: left top;
            -ms-transform-origin: left top;
            -o-transform-origin: left top;
            transform-origin: left top;
            border-right: 15px solid white;
            border-top: 15px solid white;
            border-radius: 2.5px !important;
            content: '';
            left: 30px;
            top: 75px;
            position: absolute;
        }

        @-webkit-keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }

            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }

            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }

        @-moz-keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }

            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }

            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }

        @keyframes checkmark {
            0% {
                height: 0;
                width: 0;
                opacity: 1;
            }

            20% {
                height: 0;
                width: 37.5px;
                opacity: 1;
            }

            40% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }

            100% {
                height: 75px;
                width: 37.5px;
                opacity: 1;
            }
        }



        .submit-btn {
            height: 45px;
            width: 200px;
            font-size: 15px;
            background-color: #00c09d;
            border: 1px solid #00ab8c;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px 0 rgba(87, 71, 81, .2);
            cursor: pointer;
            transition: all 2s ease-out;
            transition: all .2s ease-out;
        }

        .submit-btn:hover {
            background-color: #2ca893;
            transition: all .2s ease-out;
        }

        body {
            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%);
            min-height: 100vh;
            overflow: hidden;
        }

        .container {
            margin: 150px auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="js-container container" style="top:0px !important;"></div>

    <div style="text-align:center;margin-top:150px;position:  fixed;width:100%;height:100%;top:0px;left:0px;">
        <div class="checkmark-circle">
            <div class="background"></div>
            <div class="checkmark draw"></div>
        </div>
        <h1 class="mb-4" style="text-transform: uppercase;"><strong> <i> congratulation!</i> </strong></h1>
        <?php foreach ($get_team as $key => $team) : ?>
            <h1><strong> JUARA <?= $key + 1 ?></strong></h1>
            <h1><?= $team['nama'] ?> (Poin: <?= $team['poin'] ?>)</h1>
        <?php endforeach; ?>
    </div>

</body>
<script>
    const Confettiful = function(el) {
        this.el = el;
        this.containerEl = null;

        this.confettiFrequency = 3;
        this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E', '#EFFF1D'];
        this.confettiAnimations = ['slow', 'medium', 'fast'];

        this._setupElements();
        this._renderConfetti();
    };

    Confettiful.prototype._setupElements = function() {
        const containerEl = document.createElement('div');
        const elPosition = this.el.style.position;

        if (elPosition !== 'relative' || elPosition !== 'absolute') {
            this.el.style.position = 'relative';
        }

        containerEl.classList.add('confetti-container');

        this.el.appendChild(containerEl);

        this.containerEl = containerEl;
    };

    Confettiful.prototype._renderConfetti = function() {
        this.confettiInterval = setInterval(() => {
            const confettiEl = document.createElement('div');
            const confettiSize = (Math.floor(Math.random() * 3) + 7) + 'px';
            const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
            const confettiLeft = (Math.floor(Math.random() * this.el.offsetWidth)) + 'px';
            const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];

            confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
            confettiEl.style.left = confettiLeft;
            confettiEl.style.width = confettiSize;
            confettiEl.style.height = confettiSize;
            confettiEl.style.backgroundColor = confettiBackground;

            confettiEl.removeTimeout = setTimeout(function() {
                confettiEl.parentNode.removeChild(confettiEl);
            }, 3000);

            this.containerEl.appendChild(confettiEl);
        }, 25);
    };

    window.confettiful = new Confettiful(document.querySelector('.js-container'));
</script>
<script src="confetti.js"></script>

<script>
    startConfetti();
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {

            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');



    ga('create', 'UA-46156385-1', 'cssscript.com');

    ga('send', 'pageview');
</script>
<script src="./assets/bootstrap/js/bootstrap.min.js"></script>

</html>