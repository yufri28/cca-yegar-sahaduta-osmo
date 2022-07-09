<?php
include './koneksi.php';

$get_team = mysqli_query($conn, "SELECT * FROM team");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <title>CCA - GMIT YEGAR SAHADUTA OSMO 2022</title>
    <style>
        #demo {
            text-align: center;
            font-size: 60px;
            margin-top: 0px;
        }

        .timer {
            font-family: sans-serif;
            display: inline-block;
            padding: 24px 32px;
            border-radius: 30px;
            background: white;
        }

        .timer__part {
            font-size: 36px;
            font-weight: bold;
        }

        .timer__btn {
            width: 50px;
            height: 50px;
            margin-left: 16px;
            border-radius: 50%;
            border: none;
            color: white;
            background: #8208e6;
            cursor: pointer;
        }

        .timer__btn--start {
            background: #00b84c;
        }

        .timer__btn--stop {
            background: #ff0256;
        }
    </style>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="container mt-4 mb-5">
        <div class="card text-center">
            <div class="card-header">
                <div class="row">
                    <div class="">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            +TAMBAH TIM
                        </button>
                        <a href="./kompetisi-selesai.php" class="btn btn-success">
                            KOMPETISI SELESAI
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <h1><strong> CCA YEGAR SAHADUTA OSMO</strong></h1>
                            </div>
                            <div class="card-body">
                                <div class="timer"></div>
                                <p id="demo"></p>
                                <button type="button" onclick="restart()" class="btn btn-info">
                                    RESTART
                                </button>
                                <audio hidden controls id="audioplay">
                                    <source src="./assets/musik/bell.wav" type="audio/wav">
                                    Browsermu tidak mendukung tag audio, upgrade donk!
                                </audio>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <?php foreach ($get_team as $team) : ?>
                                <div class="col-sm-6 p-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h2 class="card-title"><strong><?= $team['nama'] ?></strong></h2>
                                            <a href="./hapus.php?id=<?= $team['id'] ?>" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg></a>
                                            <hr>
                                            <h2 class="card-text">Poin</h2>
                                            <h1>
                                                <strong class="card-text"><?= $team['poin'] ?></strong>
                                            </h1>
                                            <a href="./update-poin.php?mod=tambah&&poin=100&&id=<?= $team['id'] ?>" class="btn btn-primary">+100</a>
                                            <a href="./update-poin.php?mod=kurang&&poin=100&&id=<?= $team['id'] ?>" class="btn btn-danger">-100</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include './modal.php';
?>
<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    class Timer {
        constructor(root) {
            root.innerHTML = Timer.getHTML();

            this.el = {
                minutes: root.querySelector(".timer__part--minutes"),
                seconds: root.querySelector(".timer__part--seconds"),
                control: root.querySelector(".timer__btn--control"),
                reset: root.querySelector(".timer__btn--reset")
            };

            this.interval = null;
            this.remainingSeconds = 0;

            this.el.control.addEventListener("click", () => {
                if (this.interval === null) {
                    this.start();
                } else {
                    this.stop();
                }
            });

            this.el.reset.addEventListener("click", () => {
                const inputMinutes = 0.25;
                // const inputMinutes = prompt("Enter number of minutes:");

                if (inputMinutes < 60) {
                    this.stop();
                    this.remainingSeconds = inputMinutes * 60;
                    this.updateInterfaceTime();
                }
            });
        }

        updateInterfaceTime() {
            const minutes = Math.floor(this.remainingSeconds / 60);
            const seconds = this.remainingSeconds % 60;

            this.el.minutes.textContent = minutes.toString().padStart(2, "0");
            this.el.seconds.textContent = seconds.toString().padStart(2, "0");
        }

        updateInterfaceControls() {
            if (this.interval === null) {
                this.el.control.innerHTML = `<span class="material-icons">play_arrow</span>`;
                this.el.control.classList.add("timer__btn--start");
                this.el.control.classList.remove("timer__btn--stop");
            } else {
                this.el.control.innerHTML = `<span class="material-icons">pause</span>`;
                this.el.control.classList.add("timer__btn--stop");
                this.el.control.classList.remove("timer__btn--start");
            }
        }

        start() {
            if (this.remainingSeconds === 0) return;

            this.interval = setInterval(() => {
                this.remainingSeconds--;
                this.updateInterfaceTime();

                if (this.remainingSeconds === 0) {
                    document.getElementById("audioplay").autoplay = true;
                    document.getElementById("demo").innerHTML = "<strong>WAKTU HABIS</strong>";
                    this.stop();
                }
            }, 1000);

            this.updateInterfaceControls();
        }

        stop() {
            clearInterval(this.interval);

            this.interval = null;

            this.updateInterfaceControls();

        }

        static getHTML() {
            return `
			<span class="timer__part timer__part--minutes">00</span>
			<span class="timer__part">:</span>
			<span class="timer__part timer__part--seconds">00</span>
			<button type="button" class="timer__btn timer__btn--control timer__btn--start">
				<span class="material-icons">play_arrow</span>
			</button>
			<button type="button" class="timer__btn timer__btn--reset">
				<span class="material-icons">timer</span>
			</button>
		`;
        }
    }

    new Timer(
        document.querySelector(".timer")
    );

    function restart() {
        location.reload();
    }
</script>
<script src="./assets/fontawesome/js/all.min.js"></script>

</html>