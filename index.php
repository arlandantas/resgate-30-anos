<?php

$FTTZ = new DateTimeZone('America/Fortaleza');
$dt = new DateTime('12/02/2019 19:00', $FTTZ);
$now = new DateTime('now', $FTTZ);
$itstime = $now >= $dt;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>É SÓ ISSO AQUI - Resgate 30 anos</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            background: url('BG3.jpg');
            background-color: #000;
            background-size: cover;
            background-position: center;
            color: white;
        }
        .view {
            height: 100vh;
            width: 100vw;
            display: none;
            flex-direction: column;
            justify-content: center;
            place-items: center;
            /* background: #aad; */
        }
        /* #video {
            background: #000;
        } */
        #loading {
            /* background: #a0f; */
            font-size: 14pt;
        }
        video {
            max-width: 100%;
            max-height: 100%;
            outline: none;
        }
        input {
            border: 1px solid black;
            border-radius: .3em;
            font-size: 14pt;
            padding: .5em;
            text-align: center;
            max-width: 80vw;
        }
        button {
            cursor: pointer;
            background: #0e9a9c;
            border: none;
            border-radius: .5em;
            padding: .5em 1em;
            font-weight: bold;
            margin: .5em;
            color: white;
            max-width: 70vw;
        }
        #counter #tv, #form #tv {
            max-height: 50vh;
            max-width: 80vw;
            width: 100%;
            height: 100%;
            background: url('tv.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }
        #counter #logo, #form #logo {
            max-height: 40px;
            max-width: 80vw;
            width: 100%;
            height: 100%;
            background: url('logo_header.png');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
        }
        * {
            font-family: sans-serif;
        }
        #counter #fields {
            display: flex;
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
        }
        #counter #fields .field {
            display: flex;
            flex-direction: column;
            margin: 1em;
            justify-content: center;
            text-align: center;
            width: 80px;
        }
        #counter #fields .field .num {
            font-weight: bold;
            font-size: 2.5em;
            padding-bottom: .5em;
        }
        #counter #fields .field .desc {
            font-size: .8em;
            text-transform: uppercase;
        }
        @media (max-width: 620px) {
            #counter #fields .field {
                width: 60px;
                font-size: 10pt;
            }
        }
        @media (max-width: 450px) {
            #counter #fields .field {
                width: 50px;
                font-size: 9pt;
            }
        }
    </style>
</head>
<body>
    <?php if(!$itstime/* && !(isset($_GET['onlytest']) && $_GET['onlytest'] == 'segredo')*/) { ?>
    <div id="counter" class="view" style="display: flex;">
        <div id="logo"></div>
        <span style='font-size: .8em'>apresenta</span>
        <div id="tv"></div>
        <span style='font-size: .8em'>LANÇAMENTO EM</span>
        <div id="fields">
            <div class="field" id="d"><span class="num">##</span><span class="desc">dias</span></div>
            <div class="field" id="h"><span class="num">##</span><span class="desc">horas</span></div>
            <div class="field" id="m"><span class="num">##</span><span class="desc">minutos</span></div>
            <div class="field" id="s"><span class="num">##</span><span class="desc">segundos</span></div>
        </div>
    </div>
    <script>
        // window.data_lancamento = new Date(2019,11,2,19,0,0)
        window.data_lancamento = new Date("Dec 02 2019 19:00 GMT-03:00")
        setInterval(() => {
            let diff = window.data_lancamento - new Date()
            if (diff <= 0) {
                window.location.reload()
            }
            let dias = 0, horas = 0, minutos = 0, segundos = 0
            if (diff > 0) {
                dias = Math.floor(diff / 86400000)
                horas = Math.floor((diff % 86400000) / 3600000)
                minutos = Math.floor(((diff % 86400000) % 3600000) / 60000)
                segundos = Math.floor((((diff % 86400000) % 3600000) % 60000) / 1000)
            }
            document.querySelector("#counter .field#d .num").innerHTML = ((dias < 10 ? '0' : '') + dias)
            document.querySelector("#counter .field#d .desc").innerHTML = dias != 1 ? 'dias' : 'dia'
            document.querySelector("#counter .field#h .num").innerHTML = ((horas < 10 ? '0' : '') + horas)
            document.querySelector("#counter .field#h .desc").innerHTML = horas != 1 ? 'horas' : 'hora'
            document.querySelector("#counter .field#m .num").innerHTML = ((minutos < 10 ? '0' : '') + minutos)
            document.querySelector("#counter .field#m .desc").innerHTML = minutos != 1 ? 'minutos' : 'minuto'
            document.querySelector("#counter .field#s .num").innerHTML = ((segundos < 10 ? '0' : '') + segundos)
            document.querySelector("#counter .field#s .desc").innerHTML = segundos != 1 ? 'segundos' : 'segundo'
        }, 1000);
    </script>
    <?php } else { ?>
    <div id="form" class="view" style="display: flex;">
        <div id="logo"></div>
        <span style='font-size: .8em'>apresenta</span>
        <div id="tv"></div>
        <input type="password" id="txt_pwd" placeholder="Senha">
        <button onclick="validarSenha()">ASSISTIR!</button>
    </div>
    <div id="loading" class="view">
        Só um momento...
    </div>
    <div id="video" class="view">
        <video oncontextmenu="return false;" id="video_elmt" autoplay controls controlsList="nodownload" onerror="videoError" onloadstart="videoLoad" playsinline>
            <!-- <source src="" type="video/mp4"> -->
            Desculpe; seu navegador não suporta vídeos HTML5 em MP4 com H.264.
            <!-- Você pode embutir um Flash player aqui, para exibir seu vídeo mp4 em navegadores antigos -->
        </video>
        </video>
    </div>
    <script>
        function validarSenha() {
            let email = document.querySelector("#txt_pwd").value
            fetch('./try.php?pwd='+encodeURIComponent(email))
            .then((res) => res.text())
            .then((res) => {
                if (res === 'OK') {
                    videoLoad()
                    // document.querySelector("#video_elmt source").setAttribute('src', './doc.php?pwd='+encodeURIComponent(email))
                    var source = document.createElement('source')
                    source.setAttribute('src', './doc.php?pwd='+encodeURIComponent(email))
                    source.setAttribute('type', 'video/mp4')
                    document.querySelector("#video_elmt").appendChild(source)
                    document.querySelector("#video_elmt").play()
                } else
                    videoError('Senha inválida!')
            })
            .catch(res => videoError('Estamos com problemas'))
            document.querySelector("#loading").style.display = "flex"
            document.querySelector("#video").style.display = "none"
            document.querySelector("#form").style.display = "none"
        }
        function videoError(msg) {
            document.querySelector("#loading").style.display = "none"
            document.querySelector("#video").style.display = "none"
            document.querySelector("#form").style.display = "flex"
            alert(msg)
            document.querySelector("#txt_pwd").focus()
        }
        function videoLoad() {
            document.querySelector("#loading").style.display = "none"
            document.querySelector("#video").style.display = "flex"
            document.querySelector("#form").style.display = "none"
        }
        <?php if(isset($_GET['onlytest']) && $_GET['onlytest'] == 'segredo') { ?>
        setTimeout(function() { document.querySelector("#txt_pwd").value = 'r3sg@t3'; validarSenha() }, 300)
        <?php } ?>
    </script>
    <?php } ?>
</body>
</html>