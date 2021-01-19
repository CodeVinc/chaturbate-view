const player = new Plyr('video');

document.addEventListener("DOMContentLoaded", function(event) {

    if( document.getElementById("xs-url") != null )
    {
        const stream = document.getElementById("xs-url");
        const source = stream.getAttribute('date-file');
        const video = document.querySelector('video');
    
        if (!Hls.isSupported()) {
            video.src = source;
        } else {
    
            const hls = new Hls();
            hls.loadSource(source);
            hls.attachMedia(video);
            window.hls = hls;
        }
    
        //Quando pronto.
        player.on('ready', event => {
            if(event) {
            document.getElementById('ads-conteiner').style.display = "flex";
            }
        });
    
        //Quando assistindo.
        player.on('play', event => {
            if(event) {
            document.getElementById('ads-conteiner').style.display = "none";
            }
        });
    
        //Quando pausado.
        player.on('pause', event => {
            if(event) {
                document.getElementById('ads-conteiner').style.display = "flex";
            }
        });
            
        //tratamento de erro.
        player.on('error', event => {
            if(event) {
            alert('Não foi possivel reproduzir este video!');
            }
        });
    
        //video ads
        const adsClose = document.getElementById("ads-close");
    
        adsClose.addEventListener('click', function() {
            document.getElementById('ads-conteiner').style.display = "none";
            player.play();
        });
    }

    setInterval(function() {
        const imput = document.querySelector('#form-btn');

        if(imput.value != null || imput.value != "") {
            const replace = imput.value.replace(/\s+/, '');
            imput.value = replace;
        }

        if(imput.value === ''){
            $('#submit-btn').attr("disabled", true);
        } else {
            $('#submit-btn').attr("disabled", false);
        }

    }, 1000);

    document.querySelector('body > div:nth-child(7)').remove()
    
});
